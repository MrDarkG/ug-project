<template>
	<div class="card pl-4 shadow mt-2 pt-3 pr-4">
		<p>{{ message.user.name }} : {{  message.message_text }}</p>
	</div>
</template>


<script >
	export default{
		props:['message'],
		data(){
			return {
				
			}
		}
	};
</script>