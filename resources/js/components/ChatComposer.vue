<template>
	<div class="">
		<div class="chat-composer d-flex mt-2">
			<input type="text" placeholder="start message" v-model="newmassage" class="form-control" v-on:keydown.enter="sendMsg">
			<button class="btn btn-primary" @click="sendMsg">send</button>
		</div>	
		
		
	</div>
</template>


<script >
	export default{
		props:["user"],
		data(){
			return {
				newmassage:"",
				userdata:{}
			}
		},
		methods:{
			sendMsg(){
				axios.post("messages/store",{
					"message_text":this.newmassage
				}).then(response=>{
					console.log("yeahy")
				});
				/*this.$emit("messagesent",
					{
						message_text:this.newmassage,
						user:{name:this.user.name},
					}
				);*/
				this.newmassage="";
				var container =document.getElementById("messages")
            	container.scrollTop = container.scrollHeight;
			},
		},
		mounted(){
			this.userdata=this.user
		}
	};
</script>