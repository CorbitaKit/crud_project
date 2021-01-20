<template>
	<div>
		<el-card class="box-card">
			<div class="d-sm-flex align-items-center justify-content-between mb-4">
	        	<h1 class="h3 mb-0 text-gray-800">Orders</h1>
	            
	            <router-link to="/add-order" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
	            	<i class="fas fa-cart-plus fa-m text-white-50"></i> Add new order
	            </router-link>
	        </div>
			<el-table
	    		:data="orders"
	    		style="width: 100%">
	    		<el-table-column
	      			label="Created"
	  				width="200">
		       		<template slot-scope="scope">
		        		<i class="el-icon-time"></i>
		        		<span style="margin-left: 10px">{{ scope.row.created_at }}</span>
		      		</template>
	    		</el-table-column>
	    		<el-table-column
	      			label="Transaction Number"
	      			width="350">
	      			<template slot-scope="scope">
        				<el-popover trigger="hover" placement="top">
	          				<p>Customer: {{ scope.row.customer.firstname }} {{ scope.row.customer.lastname}}</p>
	          				<p>Addr: {{ scope.row.customer.address }}</p>
	          				<p>Phone: {{ scope.row.customer.phone }}</p>
	          				<div slot="reference" class="name-wrapper">
	            				<el-tag size="medium">{{ scope.row.transaction_number }}</el-tag>
	         				 </div>
        				</el-popover>
      				</template>
	    		</el-table-column>
	    		
	    	



	    		<el-table-column
	      			label="Status"
	      			width="300">
	      			<template slot-scope="scope">
		        		<span style="margin-left: 10px">{{ scope.row.status }}</span>
	      			</template>
	    		</el-table-column>
	    		
	    		<el-table-column
	      			label="Operations"
	      			width="300">
	      			<template slot-scope="scope">
	        			
	          			<el-button
	         				size="mini"
	          				type="primary"
	          				@click="handleDelete(scope.row.id)">View Order Summary</el-button>
	      			</template>
	    		</el-table-column>
	  		</el-table>
	  	</el-card>
	</div>
</template>

<script>

	import Swal from 'sweetalert2'

	export default{
		name : 'user-layout',

		data(){
			return{
				orders : [],
			}
		},

		created(){
			this.fetchOrders()
		},

		methods : {
			fetchOrders(){
				axios.get('/api/get-orders')
				.then(response=>{
					this.orders = response.data
				})
			},

			// handleEdit(id){
			// 	this.$router.push({name : 'add-customer',params : {customerId : id}})
			// },

			// handleDelete(id){
			// 	Swal.fire({
			// 		title: 'Are you sure?',
			// 	  	text: "You won't be able to revert this!",
			// 	  	icon: 'warning',
			// 	  	showCancelButton: true,
			// 	  	confirmButtonColor: '#3085d6',
			// 	  	cancelButtonColor: '#d33',
			// 	  	confirmButtonText: 'Yes, delete it!'
			// 		}).then((result) => {
			// 	  		if (result.isConfirmed) {
			// 	    		axios.delete('/api/delete-customer/'+id)
			// 	    		.then(()=>{
			// 	    			Swal.fire(
			// 		      			'Deleted!',
			// 		      			'Customer has been deleted.',
			// 		      			'success'
			// 	    			)

			// 	    			this.fetchUsers()
			// 	    		})	
			// 	  		}
			// 	})
			// }
		}
	};
</script>