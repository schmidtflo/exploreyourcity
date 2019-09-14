<template>
	<layout>
		<h1 class="text-2xl">Hello World</h1>
		<p>Welcome to my first Inertia.js app!</p>

		<div class="container mx-auto">
			<label class="block">
				<span class="text-gray-700">Name</span>
				<input class="form-input mt-1 block w-full" placeholder="Jane Doe">
			</label>

			<div class="mt-4">
				<span class="text-gray-700">Account Type</span>
				<div class="mt-2">
					<label class="inline-flex items-center">
						<input type="radio" class="form-radio" name="accountType" value="personal">
						<span class="ml-2">Personal</span>
					</label>
					<label class="inline-flex items-center ml-6">
						<input type="radio" class="form-radio" name="accountType" value="busines">
						<span class="ml-2">Business</span>
					</label>
				</div>
			</div>

			<label class="block mt-4">
				<span class="text-gray-700">Requested Limit</span>
				<select class="form-select mt-1 block w-full">
					<option>$1,000</option>
					<option>$5,000</option>
					<option>$10,000</option>
					<option>$25,000</option>
				</select>
			</label>

			<div class="flex mt-6">
				<label class="flex items-center">
					<input type="checkbox" class="form-checkbox">
					<span class="ml-3">I agree to the <span class="underline">privacy policy</span></span>
				</label>
			</div>
		</div>
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
