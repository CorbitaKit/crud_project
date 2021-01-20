<template>
	<div>
		<el-card class="box-card">
			<el-form ref="customer" :model="customer" label-width="200px">
	  			<el-form-item label="Firstname">
	    			<el-input v-model="customer.firstname"></el-input>
	  			</el-form-item>

	  			<el-form-item label="Lastname">
	    			<el-input v-model="customer.lastname"></el-input>
	  			</el-form-item>

	  			<el-form-item label="Email">
	    			<el-input v-model="customer.email"></el-input>
	  			</el-form-item>

	  			<el-form-item label="Phone Number">
	    			<el-input v-model="customer.phone"></el-input>
	  			</el-form-item>


	  			<el-form-item label="Address">
    				<el-input type="textarea" v-model="customer.address"></el-input>
  				</el-form-item>


	  			<el-form-item>
    				<el-button @click="cancelAction" type="danger">Cancel</el-button>

    				<el-button type="primary" @click="storeCustomer" v-if="! is_edit">Create</el-button >
    				<el-button type="primary" @click="updateCustomer" v-else>Update</el-button>
  				</el-form-item>
			</el-form>
		</el-card>
	</div>
</template>

<script>
	import Swal from 'sweetalert2'
	export default{
		name : 'add-customer',
		data(){
			return{
				is_edit : false,
				customer : {
					firstname : '',
					lastname : '',
					email : '',
					address : '',
					phone : '',
					
				}
			}
		},

		created(){
			if(this.$route.params.customerId){
				this.getCustomerData(this.$route.params.customerId)
				this.is_edit = true
			}
		},

		methods : {
			cancelAction(){
				this.$router.back()
			},

			storeCustomer(){
				

				axios.post('/api/store-customer',this.customers)
				.then(()=>{
					Swal.fire(
				    	'Success!',
				      	'Customer created successfully.',
				      	'success')
					this.$router.push('/customer')
				})
			},

			updateCustomer(){

				axios.put('/api/update-customer/'+this.$route.params.customerId,this.customer)
				.then(()=>{

					Swal.fire(
				    	'Updated!',
				      	'Customer updated successfully.',
				      	'success')
					this.$router.push('/customer')
				})
			},



			getCustomerData(id){
				axios.get('/api/get-customer/'+id)
				.then(response=>{
					this.customer = response.data
				})
			},

			
		}
	};
</script>