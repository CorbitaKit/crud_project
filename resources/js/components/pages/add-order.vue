<template>
	<div>
		<el-card class="box-card">
			<el-form ref="order" :model="order" label-width="200px">
				<el-form-item label="Transaction Number">
	    			<el-input v-model="order.transaction_number"></el-input>
	  			</el-form-item>

	  			<el-form-item label="Customer">
	    			<el-select v-model="order.customer" clearable placeholder="Select">
				    	<el-option
				    		v-for="customer in customers"
				      		:key="customer.value"
				      		:label="customer.label"
				      		:value="customer">
				    	</el-option>
				  	</el-select>
	  			</el-form-item>


	  			<el-form-item label="Products">
	    			<el-select v-model="order.order_products" clearable multiple placeholder="Select">
				    	<el-option
				    		v-for="product in products"
				      		:key="product.value"
				      		:label="product.label"
				      		:value="product">
				    	</el-option>
				  	</el-select>
	  			</el-form-item>

		  			

	  			<el-form-item label="Product Ordered: " v-if="order.order_products.length > 0">
	  				<div v-for="(ordered,i) in order.order_products">
		    			<div class="row">
			  				<div class="col-md-5">
			  					<span>Product Name</span>
			  					<el-input v-model="ordered.label" :disabled="true"></el-input>
			  					
			  				</div>
			  				<div class="col-md-2">
			  					<span>Price</span>
			  					<el-input v-model="ordered.price" :disabled="true"></el-input>
			  				</div>
			  				<div class="col-md-2">
			  					<span>Total amount</span>
			  					<el-input v-model="ordered.total" :disabled="true"></el-input>
			  				</div>
			  				<div class="col-md-1">
			  					<span>Quantity</span>
			  					<el-input-number v-model="ordered.quantity" :min="0" :max="ordered.original_quantity" @change="handleChange(i)"></el-input-number>
			  				</div>
			  				
			  			</div>
			  			<br>
			  		</div>

	  			</el-form-item>
	  			
	  			

	  			
	  			
	  			<el-form-item>
    				<el-button @click="cancelAction" type="danger">Cancel</el-button>
    				<el-button type="primary" @click="storeOrder">Create Order</el-button>
    				
  				</el-form-item>
			</el-form>
		</el-card>
	</div>
</template>

<script>
	import Swal from 'sweetalert2'
	export default{
		name : 'add-product-page',
		data(){
			return{
				order : {
					customer : '',
					order_products : [],
					transaction_number : ''
					
				},

				customers : [],
				products : [],
				

			}
		},

		created(){
			// if(this.$route.params.productId){
			// 	this.is_edit = true
			// 	this.getProduct(this.$route.params.productId)
			// }

			this.fetchCustomers()
			this.fetchProducts()
			this.generateTransactionNumber()
		},
		methods : {
			cancelAction(){
				this.$router.back()
			},


			fetchCustomers(){
				axios.get('/api/get-customers')
				.then(response=>{
					response.data.forEach(customer=>{
						this.customers.push({value : customer.id, label : customer.firstname+" "+customer.lastname})
					})
				})
			},

			fetchProducts(){
				axios.get('/api/get-products')
				.then(response=>{
					response.data.forEach(product=>{
						this.products.push({value : product.id, label : product.product_name, price : product.price, quantity: 0, original_quantity : product.quantity, total : 0})
					})
				})
			},

			handleChange(i,value){

			
				this.order.order_products[i].total = this.order.order_products[i].price*this.order.order_products[i].quantity

				
			},

			storeOrder(){
				axios.post('/api/create-order',this.order)
				.then(response=>{
					Swal.fire(
				    	'Success!',
				      	'Order created successfully.',
				      	'success')
					this.$router.push('/order')
				})
			},

			generateTransactionNumber(){
				var result = Math.random().toString(36).substring(2,7);

				this.order.transaction_number = this.order.transaction_number+""+result+"-"

				result = Math.random().toString(36).substring(2,7);

				this.order.transaction_number = this.order.transaction_number+""+result+"-"

				result = Math.random().toString(36).substring(2,7);

				this.order.transaction_number = this.order.transaction_number+""+result

				this.order.transaction_number = this.order.transaction_number.toUpperCase()
			}
			
			


		}
	};
</script>

<style scoped>
	.el-select{
		width: 100% !important
	}
</style>