<?php

namespace App\Console\Commands\Importer\Berlin;

use App\City;
use App\Line;
use App\LineType;
use App\Station;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportLinesAndStations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:cities:berlin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private $allowedLineTypes = ['subway', 'suburban'];
    private $allowedOperators = [1, 796];
    private $colors;

    private $stationMapping = [];
    private $indexedStations = [];

    private $linesToImport = [];

    private $city;
    private $ubahn;
    private $sbahn;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
	    $this->city = City::where('name', 'Berlin')->first();
	    $this->ubahn = LineType::where('name', 'U-Bahn')->where('city_id', $this->city->id)->first();
	    $this->sbahn = LineType::where('name', 'S-Bahn')->where('city_id', $this->city->id)->first();

        $lines = json_decode(Storage::get('cities/berlin/lines.json'));
        $stations = json_decode(Storage::get('cities/berlin/stations_full.json'));
        $this->colors = json_decode(Storage::get('cities/berlin/colors.json'));

		$this->createStationMapping($stations);

	    $indexedStations = [];

	    foreach($stations as $station) {
		    $indexedStations[$station->id] = $station;
	    }
	    $this->indexedStations = $indexedStations;

	    $lineoptions = [];

        foreach($lines as $line) {
        	if(!in_array($line->product, $this->allowedLineTypes) || !in_array($line->operator, $this->allowedOperators)) {
        		continue;
	        }

	        $variant = $this->getVariantWithHighestStationAmount($line->variants);

	        $lineoptions[] = [
	        	'name' => $line->name,
		        'path' => $variant,
		        'line' => $line
	        ];
        }

        $lineoptions = collect($lineoptions)->groupBy('name')->sortKeys();

        $this->askForLineToBeUsed($lineoptions, $indexedStations);

        $this->importLines();
    }

	private function createStationMapping($stations)
	{
		foreach($stations as $station) {
			foreach($station->stops as $stop) {
				$this->stationMapping[$stop->id] = $stop->station;
			}
		}
	}

	private function getVariantWithHighestStationAmount($variants)
	{
		$highestStationAmount = 0;
		$stops = [];

		foreach($variants as $variant) {
			if(count($variant->stops) > $highestStationAmount) {
				$highestStationAmount = count($variant->stops);
				$stops = $variant->stops;
			}
		}

		return $stops;
	}

	private function askForLineToBeUsed($lineoptions, $indexedStations)
	{
		foreach($lineoptions as $name => $lineoption) {
			if(count($lineoption) == 1) {
				$this->linesToImport[] = $lineoption[0];
				continue;
			}

			$this->info('Option for Line ' . $name);

			$options= [];

			foreach($lineoption as $possibleoption) {
				$firstStationName = $indexedStations[$this->stationMapping[$possibleoption['path'][0]]]->name;
				$lastStationName = $indexedStations[$this->stationMapping[end($possibleoption['path'])]]->name;

				$options[] = "From $firstStationName to $lastStationName";
			}

			$choosenIndex = $this->choice("Which path should be used?", $options);

			$this->linesToImport[] = $lineoption[array_search($choosenIndex, $options)];
		}
	}

	private function importLines()
	{
		foreach($this->linesToImport as $line) {
			// First, create Line
			$product = $line['line']->product;
			$name = $line['line']->name;
			$lineModel = Line::create([
				'name' => $name,
				'line_type_id' => ($product == 'suburban') ? $this->sbahn->id : $this->ubahn->id,
				'city_id' => $this->city->id,
				'color_background' => $this->colors->$product->$name->bg,
				'color_foreground' => $this->colors->$product->$name->fg
			]);
			$index = 10;

			// Second, create & attach all Stations
			foreach($line['path'] as $station) {
				$station = $this->indexedStations[$this->stationMapping[$station]];
				$name = $this->cleanupStationName($station->name);
				$longitude = $station->location->longitude;
				$latitude = $station->location->latitude;

				$station = Station::where('city_id', $this->city->id)->firstOrCreate([
					'name' => $name
				], [
					'latitude' => $latitude,
					'longitude' => $longitude,
					'city_id' => $this->city->id
				]);

				$lineModel->stations()->attach($station->id, ['position' => $index]);

				$index += 10;

			}
		}
	}

	private function cleanupStationName(string $name): string
	{
		$name = preg_replace('/^S?\+?U? /', '', $name);
		$name = preg_replace('/\[U\d\]/', '', $name);
		$name = preg_replace("/\(Berlin\)/", '', $name);
		$name = preg_replace("/\(Bln\)/", '', $name);
		$name = preg_replace("/\(T[fF]\)/", '', $name);
		$name = preg_replace("/Bhf/", '', $name);
		$name = trim($name);
		$name = preg_replace("/tr\.$/", 'traße', $name);
		return $name;
	}
}
