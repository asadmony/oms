<template>
    <tr class="nowrap">
        <td>
            {{ order.id }}
        </td>
        <td>
            <router-link class="btn-link" :to="{ name: 'agent.ecom.order.details', params:{orderId: order.id}}">Details</router-link>
        </td>
        <td  :class="{'w3-green':  order.order_status == 'shipped', 'w3-blue':  order.order_status == 'confirmed', 'w3-purple':  order.order_status == 'processing', 'w3-orange':  order.order_status == 'delivered'}">
            {{ order.order_status }}
        </td>
        <td>
            {{ order.mobile }}
        </td>
        <td>
            {{ order.created_at | date}}
        </td>
        <td>
            {{ order.total_price }}
        </td>
        <td>
            {{ order.items.length }}
        </td>
    </tr>
</template>
<style scoped>
.nowrap{
    white-space: nowrap;
}
</style>
<script>
export default {
    props: [
        'order'
    ],
    data() {
        return {
        }
    },
}
</script>