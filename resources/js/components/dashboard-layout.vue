<template>
	<div>
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Customers</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ customers.length}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                   Products</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ products.length}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-tag fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pending Orders
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ pending_orders.length}}</div>
                                    </div>
                                  
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-cart-arrow-down fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Approved Orders</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ approved_orders.length }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-12 col-lg-12">
            <OrderLayout></OrderLayout>
        </div>
        <br>
        <div class="col-xl-12 col-lg-12">
            <ProductLayout></ProductLayout>
        </div>
	</div>
</template>

<script>
import OrderLayout from './pages/order-page.vue'
import ProductLayout from './pages/product-page.vue'

export default({
    components : {
        OrderLayout,
        ProductLayout
    },

    data(){
        return{
            customers : [],
            products : [],
            approved_orders: [],
            pending_orders : [],
        }
    },

    created(){
        this.fetchCustomers()
        this.fetchProducts()
        this.fetchApprovedOrders()
        this.fetchPendingOrders()
    },

    methods : {
        fetchCustomers(){
            axios.get('/api/get-customers')
            .then(response=>{
                this.customers = response.data
            })
        },

        fetchProducts(){
            axios.get('/api/get-products')
            .then(response=>{
                this.products = response.data
            })
        },

        fetchApprovedOrders(){
            axios.get('/api/get-approved-orders')
            .then(response=>{
                this.approved_orders = response.data
            })
        },

        fetchPendingOrders(){
            axios.get('/api/get-pending-orders')
            .then(response=>{
                this.pending_orders = response.data
            })
        }
    }
});	
</script>