<template>
    <div class="padding-around">
        <div class="card card-body  w3-animate-zoom">
            <div class="h1">OMS SR Dashboard</div>

            <div class="row">
                <div class="col-md-6 p-2">
                    <div class="card w3-blue">
                        <div class="card-body">
                            Monthly Target : &#2547; {{ sr.monthly_target }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-2">
                    <div class="card w3-blue">
                        <div class="card-body">
                            Current Month Sale : &#2547; {{ sr.monthly_target }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-2">
                    <div class="card w3-blue">
                        <div class="card-body">
                            Current Month Collection : &#2547; {{ sr.monthly_target }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-2">
                    <div class="card w3-blue">
                        <div class="card-body">
                            Total Sales : &#2547; {{ sr.total_sale }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-2">
                    <div class="card w3-blue">
                        <div class="card-body">
                            Total Collection : &#2547; {{ sr.total_collection }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import eventBus from './../../../../event-bus'
export default {
    props: ['agent'],
    data() {
        return {
            sr: [],
            current_month_sale: 0,
            current_month_collection: 0,
        }
    },
    created() {
        this.getDashboardData()
    },
    methods: {
        getDashboardData(){
            axios.get(window.location.origin+`/api/agent/${this.agent}/dashboard/info`).then(res => {
				if (res.status == 200) {
					this.sr = res.data.agent
					this.current_month_sale = res.data.current_month_sale
					this.current_month_collection = res.data.current_month_collection
				}
			});
        }
    },
}
</script>
