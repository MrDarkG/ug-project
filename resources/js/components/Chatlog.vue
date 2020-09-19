<template>
	<div class="" style="max-height:88vh;overflow-y:auto" id="messages">
		<chat-message v-for="message in messages" :message="message" v-bind:key="message.message" >
			
		</chat-message>
		
		
		
	</div>
</template>


<script >
	export default{
		props:["messages"],
		data(){
			return {
				
			}
		}
	};
</script>