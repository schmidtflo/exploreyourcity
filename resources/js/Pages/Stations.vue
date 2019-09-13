<template>
	<layout>
		Stationen!

		<ul>
			<li v-for="station in stations">
				<span v-text="station.id"></span>
				<span v-text="station.name"></span>
			</li>
		</ul>

		<ul>
			<li v-for="(key, value) in count">
				<span>Key: {{ key }}, Value: {{ value }}</span>
			</li>
		</ul>
	</layout>
</template>

<script>
	import Layout from '@/Shared/Layout'
	import countBy from 'lodash/countBy'

	export default {
		name: "Stations",

		components: {
			Layout,
		},

		props: {
			stations: {
				default: () => []
			}
		},

		computed: {
			count() {
				let count = countBy(this.stations, 'length');
				console.log(count);
				return count;
			}
		}
	}
</script>
