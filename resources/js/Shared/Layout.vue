<template>
	<main>
		<header>
			<inertia-link :href="route('dashboard')">Dashboard</inertia-link>
			<inertia-link :href="route('stations')">Stations</inertia-link>
		</header>

		<article>
			<slot />
		</article>
	</main>
</template>
