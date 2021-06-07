<template>
  <div>
      <div class="card">
          <div class="card-header h4 w3-deep-orange">
              Order # {{ orderId }}
          </div>
          <div class="card-body" v-if="order">
              <div class="h6">
                  Placed at: {{ order.created_at | date }}
              </div>
              <div class="h6">
                  Amount: &#2547;{{ order.total_price }}
              </div>
              <div class="h6">
                  Total Items: {{ order.items.length }}
              </div>
              <div class="h6">
                  <b>Order For:</b> <br>
                  Mobile: {{ order.mobile }} <br>
                  Source: {{ order.order_for_source ? order.order_for_source.name.en : '' }} <br>
              </div>
              <div class="h6">
                Status : <span class="badge badge-primary">{{order.order_status}}</span>
              </div>
          </div>
      </div>
      <div class="card">
          <div class="card-header h6 w3-blue">
              Order Items
          </div>
          <div class="card-body" v-if="order">
              <div class="table-responsive">
                  <table class="table table-bordered">
                      <tr>
                          <th>Product #</th>
                          <th>Name</th>
                          <th>Qty.</th>
                          <th>Price</th>
                      </tr>
                      <tr v-for="(item, index) in order.items" :key="index">
                          <td>{{item.product_id}}</td>
                          <td>{{item.product_name.en}}</td>
                          <td>{{item.total_quantity}}</td>
                          <td>{{item.total_price}}</td>
                      </tr>
                  </table>
              </div>
          </div>
      </div>
    <div v-if="order != null">
      <order-shipment v-if="order.order_status == 'shipped' || order.order_status == 'delivered'  || order.order_status == 'collected'" :orderId="orderId" :agent="agent" ></order-shipment>

    </div>
  </div>
</template>

<script>
export default {
    props:['agent', 'orderId'],
    data() {
        return {
            order: null,
        }
    },
    created() {
        this.getOrderDetails()
    },
    methods: {
        getOrderDetails(){
            axios.get(window.location.origin+`/api/agent/${this.agent}/ecommerce/order/${this.orderId}/details`).then(res => {
                if (res.status == 200) {
                    this.order = res.data
                }else{
                    console.log(res.data)
                }
            })
        },
    },
}
</script>

<style>

</style>
