/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vue           from 'vue'
import Notifications from 'vue-notification'
Vue.use(Notifications)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
Vue.component('chat-composer', require('./components/ChatComposer.vue').default);
Vue.component('chat-message', require('./components/ChatMessageComponent.vue').default);
Vue.component('chat-log', require('./components/Chatlog.vue').default);
Vue.component('ideas', require('./components/IdeasComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data:{
    	messages:[
			
		],
		ideas:[
		]
	},
    methods:{
    	addmessage(message){
    		this.messages.push(message)
    	}
    },
    created(){
    	axios.get("/getMessage").then(response=>{
			this.messages=response.data
    	});
    	axios.get("/ideas").then(response=>{
            this.ideas=response.data
        });
        // waiting for new messages
    	Echo.join('chatroom')
    	.listen('MessagePosted',(e)=>{
    		this.messages.push({
                message_text:e.message.message_text,
                user:{name:e.user.name}
            })
    	});
        // waiting for new likes

        Echo.join('newlike')
        .listen('NewLike',(e)=>{
            axios.get("/ideas").then(response=>{
                this.ideas=response.data
            });
            
        });


        // waiting for new Ideas

    	Echo.join('newidea')
        .here((user)=>{
        })
        .joining((user)=>{
        })
        .leaving((user)=>{
        })
    	.listen('IdeaPosted',(e)=>{
            console.log(e)
    		this.ideas.push({
    			title:e.idea.title,
    			user:{name:e.user.name},
                id:e.idea.id,
    			votes_count:0,
    		})
    	});

    	
    },

});
