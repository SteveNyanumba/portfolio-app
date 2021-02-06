<template>
<div>
    <!-- Portfolio Item -->
<div class="bg-cool-gray-200 shadow-lg hover:shadow-xl" @click="show=!show">
    <div class="">
        <img :src="image"
            class="h-56 w-full border-blue-200 border-2 hover:opacity-25">
    </div>
    <div class="px-4 py-4 md:px-10">
        <h1 class="font-bold text-lg text-center">
            {{title}}
        </h1>
        <p class="py-4">
           {{content}}
        </p>
        <div class="flex flex-wrap pt-6 text-blue-900">
            <div class="w-full md:w-full text-xs font-medium ">
                {{new Date(date).toDateString()}}
            </div>

        </div>
    </div>
</div>
<!-- End Portfolio Item -->
<dialog-modal
    :show="show">
    <template #title>
        <i class="fa fa-times-circle fa-lg right-auto text-blue-200 hover:text-blue-400" @click="show=!show"></i>
    </template>
    <template #content>

    </template>

</dialog-modal>
</div>
</template>

<script>
import DialogModal from '../Jetstream/DialogModal.vue'
export default {
    props:{
        image:String,
        title:String,
        content:String,
        date:String
    },
    components:{
        DialogModal
    },
    data(){
        return{
            show:false,

        }
    },
    methods:{

    }
}
</script>

<style>

</style>
