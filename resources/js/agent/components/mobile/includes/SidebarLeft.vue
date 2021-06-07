<template>
<div>
	<i class="screen-overlay"></i>
    <aside class="offcanvas" id="sidebar_left">
	<div class="card-body bg-primary">
		<button class="btn-close close text-white">&times;</button>
		<img :src="webLogo" class="img-sm rounded-circle" alt="">
		<h6 class="text-white mt-3 mb-0">Welcome SR!</h6>
	</div>
	<nav class="nav-sidebar my-1">
		<router-link class="btn-close" :to="{name: 'agent.ecommerce.home'}">
			<i class="fa fa-home"></i> Home
		</router-link>
		<!-- <router-link class="btn-close" :to="{name: 'agent.ecom.user.list'}">
			<i class="fas fa-users"></i>
			Amar listed Customers
		</router-link> -->
		<router-link class="btn-close" :to="{name: 'agent.ecom.source.list'}">
			<i class="fas fa-industry"></i>
			Shops
		</router-link>
		<router-link class="btn-close" :to="{name: 'agent.ecommerce.order.list'}">
			<i class="fa fa-cube"></i>
			Orders
		</router-link>
		<router-link class="btn-close" :to="{name: 'agent.ecom.return.list'}">
			<i class="fas fa-truck-loading"></i>
			Returns
		</router-link>
		<!-- <router-link class="btn-close" :to="{name: 'agent.ecommerce.product.list'}">
			<i class="fa fa-th"></i> Products
		</router-link> -->
		<router-link class="btn-close" :to="{name: 'agent.ecom.collection.list'}">
			<i class="fas fa-money-check-alt"></i>
			Collections
		</router-link>
	</nav>
	<!-- <hr>
	<nav class="nav-sidebar my-0 py-0">
		<a href="/agent"><i class="fa fa-arrow-left" aria-hidden="true"></i> Switch SR</a>
	</nav> -->
	<hr>
	<nav class="nav-sidebar">
		<a href="#"> <i class="fa fa-phone"></i> {{ sr.user.mobile }}</a>
		<a href="#"> <i class="fa fa-envelope"></i> {{ sr.user.name }}</a>
		<a href="#"> <i class="fa fa-map-marker"></i> {{ sr.name.en }}</a>

		<a @click="logout()"> <i class="fas fa-power-off"></i> Logout</a>
	</nav>
</aside>
</div>
</template>

<script>
export default {
	props: ['agent'],
	data() {
		return {
			sr: {
				name: {
					en : 'SR',
				},
				user: {
					name: 'Name',
					mobile: '01XXXXXXXXX',
				},
			},
			webLogo: window.location.origin+'/img/dhpl.jpg',
		}
	},
	created() {
		this.getSrInfo()
	},
	methods: {
		logout(){
			axios.post(window.location.origin+'/logout').then(res => {
				window.location.reload();
			})
				window.location.reload();
		},
		getSrInfo(){
			var path = window.location.pathname
			var splitPath = path.split("/")
			axios.get(window.location.origin+`/api/agent/${splitPath[2]}/info`).then(res => {
				if (res.status == 200) {
					this.sr = res.data
				}
			});
		}
	},
}
</script>