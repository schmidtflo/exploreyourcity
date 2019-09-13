<template>
	<layout>
		<h1 class="text-2xl">Hello World</h1>
		<p>Welcome to my first Inertia.js app!</p>
	</layout>
</template>

<script>
	import Layout from '@/Shared/Layout'
	import shuffle from 'lodash/shuffle'

	export default {
		components: {
			Layout,
		},

		mounted() {
			console.log(this.count);
		},

		computed: {
			count() {
				let arr = shuffle([1,2,3,4]);
				console.log(arr);
				return arr;
			}
		}
	}
</script>
