<template>
	<layout>
		Stationen!

		<ul>
			<li v-for="station in stations">
				<span v-text="station.id"></span>
				<span v-text="station.name"></span>
			</li>
		</ul>
	</layout>
</template>

<script>
	import Layout from '@/Shared/Layout'

	export default {
		name: "Stations",

		components: {
			Layout,
		},

		props: {
			'stations': {
				default: () => []
			}
		}
	}
</script>
