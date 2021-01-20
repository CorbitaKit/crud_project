<template>
	<div>
		<el-card class="box-card">
			<el-form ref="product" :model="product" label-width="200px">
	  			<el-form-item label="Product Name">
	    			<el-input v-model="product.product_name"></el-input>
	  			</el-form-item>

	  			<el-form-item label="Quantity">
	    			<el-input v-model="product.quantity"></el-input>
	  			</el-form-item>

	  			<el-form-item label="Price">
	    			<el-input v-model="product.price"></el-input>
	  			</el-form-item>

	  			<el-form-item label="Description">
    				<el-input type="textarea" v-model="product.description"></el-input>
  				</el-form-item>
	  			
	  			<el-form-item>
    				<el-button @click="cancelAction" type="danger">Cancel</el-button>
    				<el-button type="primary" @click="createProduct" v-if="! is_edit">Create</el-button>
    				<el-button type="primary" @click="updateProduct" v-else>Update</el-button>
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
				product : {
					product_name : '',
					price : '',
					quantity : '',
					description : '',
					
				},
				is_edit :false
			}
		},

		created(){
			if(this.$route.params.productId){
				this.is_edit = true
				this.getProduct(this.$route.params.productId)
			}
		},
		methods : {
			cancelAction(){
				this.$router.back()
			},

			createProduct(){

				

				axios.post('/api/store-product',this.product)
				.then(response=>{
					Swal.fire(
				    	'Success!',
				      	'Product created successfully.',
				      	'success')

					this.$router.push('/product')
				})
			},

			getProduct(id){

				axios.get('/api/get-product/'+id)
				.then(response=>{
					this.product = response.data
				})
			},

			updateProduct(){
				axios.put('/api/update-product/'+this.$route.params.productId, this.product)
				.then(()=>{
					Swal.fire(
				    	'Updated!',
				      	'Product updated successfully.',
				      	'success')

					this.$router.push('/product')
				})
			}


		}
	};
</script>