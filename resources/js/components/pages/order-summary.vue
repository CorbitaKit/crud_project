<template>
	<div>
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Order Summary</h1>
            <a href="#"  class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            	<i class="fas fa-download fa-sm text-white-50"></i> Print Order Summary</a>


        </div>
        <el-card class="box-card" id="printable">
	        <div class="row">
	        	<div class="col-md-4">
	        		Transaction Number: <strong>{{ order.transaction_number }}</strong>
	        	</div>
	        	<div class="col-md-4"></div>
	        	<div class="col-md-4">
	        		Date: <strong>{{ moment(order.created_at).format("MMM Do, YYYY") }}</strong>
	        	</div>
	        	
	        </div>
	        <br>
	        <div class="row">
	        	<div class="col-md-8">
	        		<el-card shadow="never">
				      Customer Information:

				      <table class="table table-bordered table-hover">
				      	
				      	<tbody>
				      		<tr>
				      			<td>Name: </td>
				      			<td> {{ order.customer.firstname}} {{ order.customer.lastname }}</td>
				      		</tr>
				      		<tr>
				      			<td>Address</td>
				      			<td>{{ order.customer.address}}</td>
				      		</tr>
				      		<tr>
				      			<td>Email</td>
				      			<td>{{ order.customer.email}}</td>
				      		</tr>
				      		<tr>
				      			<td>Phone Number</td>
				      			<td>{{ order.customer.phone }}</td>
				      		</tr>
				      	</tbody>
				      </table>
				    </el-card>
	        	</div>
	        	<div class="col-md-4">
	        		Shipping Address: 

	        		<div class="alert alert-danger">
	        			
	        			<strong>Shipping functionality!</strong> Not yet implemented!
	        		</div>
	        	</div>
	        	
	        </div>
	        <br>
	        <div class="row">
	        	<div class="col-md-6">
	        		Order Detail:
	        	</div>
	        </div>
	        <br>
	        <div class="row">
	        	<div class="col-md-12">
	        		<table class="table table-bordered table-hover">
	        			<thead>
	        				<tr>
	        					<th>Product</th>
	        					<th>Price</th>
	        					<th>Quantity</th>
	        					<th>Amount</th>

	        				</tr>
	        			</thead>
	        			<tbody>
	        				<tr v-for="product in order.ordered_products"> 
	        					<td>{{ product.product[0].product_name }}</td>
	        					<td>{{ product.product[0].price }}</td>
	        					<td>{{ product.total_quantity }}</td>
	        					<td>{{ product.total_amount}}</td>
	        					
	        				</tr>


	        				<tr>
	        					<td class="last_row"></td>
	        					<td class="last_row"></td>
	        					<td>Total Quantity: {{ getTotalQuantity() }}</td>
	        					<td>Total Amount: {{ getTotalAmount() }}</td>
	        				</tr>
	        			</tbody>
	        		</table>
	        	</div>
	        </div>
		</el-card>


	</div>
</template>


<script>
	import moment from "moment";
	export default{

		data(){
			return{
				order_id : '',
				order : [],
				moment: moment,
				total_quantity : 0,
				total_amount : 0,
			}
		},

		created(){
			this.order_id = this.$route.params.orderId


			this.fetchOrder()
			
			
		},

		methods : {
			fetchOrder(){
				axios.get('/api/get-order/'+this.order_id)
				.then(response=>{
					this.order = response.data
				})
			},

			getTotalQuantity(){

				for(var i in this.order.ordered_products){
					this.total_quantity += this.order.ordered_products[i].total_quantity
				}

				return this.total_quantity
			},

			getTotalAmount(){
				for(var i in this.order.ordered_products){
					this.total_amount += this.order.ordered_products[i].total_amount
				}

				return this.total_amount
			},

			// printOrderSummary(){
			// 	var mywindow = window.open('', 'PRINT', 'height=400,width=600');

			//     mywindow.document.write('<html><head><title>' + document.title  + '</title>');
			//     mywindow.document.write('</head><body >');
			//     mywindow.document.write('<h1>' + document.title  + '</h1>');
			//     mywindow.document.write(document.getElementById('printable').innerHTML);
			//     mywindow.document.write('</body></html>');

			//     mywindow.document.close(); // necessary for IE >= 10
			//     mywindow.focus(); // necessary for IE >= 10*/

			//     mywindow.print();
			//     mywindow.close();

   // 				return true;
			// }


		}
		
	};
</script>

<style scoped>
	.last_row{
		border-bottom:none;
	}
</style>