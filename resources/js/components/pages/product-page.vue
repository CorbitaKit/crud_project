<template>
	<div>
		<el-card class="box-card">
			<div class="d-sm-flex align-items-center justify-content-between mb-4">
	        	<h1 class="h3 mb-0 text-gray-800">Products</h1>
	            
	            <router-link to="/add-product" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" v-if="is_display">
	            	<i class="fas fa-cart-plus fa-m text-white-50"></i> Add new Product
	            </router-link>
	        </div>
			<el-table
	    		:data="products"
	    		style="width: 100%">
	    		<el-table-column
	      			label="Date"
	  				width="200">
		       		<template slot-scope="scope">
		        		<i class="el-icon-time"></i>
		        		<span style="margin-left: 10px">{{ scope.row.created_at }}</span>
		      		</template>
	    		</el-table-column>

	    		<el-table-column
	      			label="Product Name"
	  				width="200">
		       		<template slot-scope="scope">
		        		
		        		<span style="margin-left: 10px">{{ scope.row.product_name }}</span>
		      		</template>
	    		</el-table-column>

	    		<el-table-column
	      			label="Price"
	  				width="120">
		       		<template slot-scope="scope">
		        		
		        		<span style="margin-left: 10px">{{ scope.row.price }}</span>
		      		</template>
	    		</el-table-column>

	    		<el-table-column
	      			label="Quantity"
	  				width="120">
		       		<template slot-scope="scope">
		        		
		        		<span style="margin-left: 10px">{{ scope.row.quantity }}</span>
		      		</template>
	    		</el-table-column>
	    		
	    		<el-table-column
	      			label="Description"
	  				width="200">
		       		<template slot-scope="scope">
		        		
		        		<span style="margin-left: 10px">{{ scope.row.description }}</span>
		      		</template>
	    		</el-table-column>


	    		<el-table-column
	      			label="Operations">
	      			<template slot-scope="scope">
	        			<el-button
	          				size="mini"
	          				@click="handleEdit(scope.row.id)">Edit</el-button>
	        			<el-button
	         				size="mini"
	          				type="danger"
	          				@click="handleDelete(scope.row.id)">Delete</el-button>
	      			</template>
	    		</el-table-column>
	  		</el-table>
	  	</el-card>
	</div>
</template>

<script>
	import Swal from 'sweetalert2'
	export default{

		name : 'product-page',

		data(){
			return{
				products : [],
				is_display : false
			}
		},

		created(){
			this.fetchProducts()
			if(this.$route.path == '/dashboard'){
				this.is_display = false
			}else if(this.$route.path == '/add-product'){
				this.is_display = true
			}
		},

		methods : {
			fetchProducts(){
				axios.get('/api/get-products')
				.then(response=>{
					this.products = response.data
				})
			},

			handleEdit(id){
				this.$router.push({name : 'add-product', params : {productId : id}})
			},

			handleDelete(id){
				Swal.fire({
					title: 'Are you sure?',
				  	text: "You won't be able to revert this!",
				  	icon: 'warning',
				  	showCancelButton: true,
				  	confirmButtonColor: '#3085d6',
				  	cancelButtonColor: '#d33',
				  	confirmButtonText: 'Yes, delete it!'
					})
					.then((result) => {
				  		if (result.isConfirmed) {
				    		axios.delete('/api/delete-product/'+id)
				    		.then(()=>{
				    			Swal.fire(
					      			'Deleted!',
					      			'Product has been deleted.',
					      			'success'
				    			)

				    			this.fetchProducts()
				    		})	
				  		}
				})
			}
		}
	};
</script>