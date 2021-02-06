<template>
  <div>
      <button @click="show=!show" class="form-input rounded-md shadow-sm bg-blue-500 text-gray-200 hover:bg-blue-700 hover:text-yellow-400">
                    Add New Category
    </button>
    <!-- Modal Form -->
    <jet-dialog-modal :show="show"  class="bg-gray-600">
        <template #title>
            <i class="fas fa-times fa-sm text-blue-200 hover:text-blue-500 float-right " @click="show=!show"></i>
        </template>
        <template #content>
            <jet-form-section>
                <template#title>
                    <h3 class="text-gray-700">
                        New Portfolio
                    </h3>
                </template>
                <template#description>
                    <p class="text-gray-500">
                        The form needed to be filled inorder to add portfolio categories
                    </p>
                </template>
                <template #form>
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label value="Category"></jet-label>
                        <jet-input type="text" v-model="category" class="mt-1 block w-full"></jet-input>
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <button type="button" class="form-input rounded-md shadow-sm bg-blue-500 text-gray-200 hover:bg-blue-700 hover:text-yellow-400" @click="submitCategory"> Submit</button>
                    </div>
                </template>
            </jet-form-section>
        </template>

    </jet-dialog-modal>
  </div>
</template>

<script>
import JetFormSection from '@/Jetstream/FormSection';
import JetDialogModal from '@/Jetstream/DialogModal';
import JetInput from '@/Jetstream/Input';
import JetLabel from '@/Jetstream/Label';
export default {
    components:{
        JetLabel,
        JetInput,
        JetDialogModal,
        JetFormSection
    },

    data(){
        return {
            show:false,
            category:''
        }
    },

    methods:{
        async submitCategory(){
            try {
                const res = await axios.post('/api/categories', {category: this.category})
                if (res.status == 200) {
                    Toast.fire({
                        title: 'Success!',
                        text: res.data,
                        icon:'success'
                    })

                }else{
                    Toast.fire({
                        icon:'error',
                        text:res.data,
                        title:'Ooops!!'
                    })
                }
            } catch (err) {
                console.log(err)
            }
        }
    }

}
</script>
