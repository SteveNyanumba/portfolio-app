<template>
    <div>
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div>
                <jet-application-logo class="block h-12 w-auto" />
            </div>

            <div class="mt-6 text-2xl">
                Welcome to your Portfolio!
            </div>

            <div class="mt-6 text-gray-500">
               The Area where you create and update all your portfolio project details that you have done in the past.
            </div>
            <div class="mr-auto mt-6">
                <button @click="show=!show" class="form-input rounded-md shadow-sm bg-blue-500 text-gray-200 hover:bg-blue-700 hover:text-yellow-400">
                    Add New Portfolio Item
                </button>
                <!-- Modal Form -->

                <jet-dialog-modal :show="show"  class="bg-gray-600">
                    <template #title>
                        <i class="fas fa-times fa-xs text-blue-200 hover:text-blue-500 float-right " @click="show=!show"></i>
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
                                    The form needed to be filled inorder to add new work items done to your portfolio
                                </p>
                            </template>
                           <template #form>
                                <div class="col-span-6 sm:col-span-4">
                                    <jet-label value="Title"/>
                                    <jet-input type="text" v-model="newPort.title" class="mt-1 block w-full"/>
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    <hr>
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    <jet-label value="Image"/>
                                    <input type="file" id="select_image" @change="addImage" class="form-input rounded-md shadow-sm mt-1 block w-full" aria-valuetext="hidden"/>
                                    <img class="mt-3" id="preview_image" src="/images/portfolio/default.jpg" alt="">
                                </div>
                               <div class="col-span-6 sm:col-span-4">
                                    <hr>
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    <jet-label value="Content"/>
                                    <textarea  v-model="newPort.content" class="mt-1 block w-full form-input rounded-md shadow-sm"/>
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    <hr>
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    <jet-label value="Category"/>
                                    <select v-model="newPort.category" class="mt-1 block w-full form-input rounded-md shadow-sm">
                                        <option selected disabled>Select Your Portfolio Category</option>
                                        <option v-for="category in categories" :key="category.id" :value="category.id">{{category.category}}</option>
                                    </select>
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    <hr>
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    <jet-label value="Link"/>
                                    <jet-input type="text" v-model="newPort.link" class="mt-1 block w-full"/>
                                 </div>
                                 <div class="col-span-6 sm:col-span-4">
                                    <hr>
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    <jet-label value="Completion Date"/>
                                    <jet-input type="date" v-model="newPort.completion" class="mt-1 block w-full"/>
                                 </div>
                                 <div class="col-span-6 sm:col-span-4">
                                    <hr>
                                </div>
                                <div class="col-span-6 sm:col-span-4">
                                    <button type="button" @click="uploadPortfolio()" class="form-input rounded-md shadow-sm bg-blue-500 text-gray-200 hover:bg-blue-700 hover:text-yellow-400">Submit</button>
                                </div>
                           </template>
                        </jet-form-section>
                    </template>

                </jet-dialog-modal>

                <portfolio-categories-form/>
            </div>
        </div>
        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-3">
            <div v-for="portfolio in portfolioItems" :key="portfolio.id" class="m-4">
                <portfolio-list-item
                    :image="`/images/portfolio/${portfolio.image}`" :title="portfolio.title"
                    :content="portfolio.content" :date="portfolio.created_at"/>
            </div>
        </div>
        <jet-dialog-modal :show=anotherShow>
            <template #title>
                <i class="fas fa-times fa-xs text-blue-200 hover:text-blue-500 float-right " @click="destroy"></i>
            </template>
            <template #content>
                <h3>Crop Image before Upload</h3>

                <div class="container mt-4">
                    <div class="col-span-12">
                        <img :src="defaultImage" id="cropping_image" />
                    </div>
                </div>
            </template>
            <template #footer>
                <button type="button" @click="save" class="form-input rounded-md shadow-sm bg-blue-500 text-gray-200 hover:bg-blue-700 hover:text-yellow-400">Set Image</button>
            </template>
        </jet-dialog-modal>
    </div>
</template>

<script>
    import JetApplicationLogo from '@/Jetstream/ApplicationLogo'
    import JetDialogModal from '@/Jetstream/DialogModal'
    import JetButton from '@/Jetstream/Button'
    import JetLabel from '@/Jetstream/Label'
    import PortfolioListItem from '@/components/PortfolioListItem'
    import JetFormSection from '@/Jetstream/FormSection'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import Cropper from 'cropperjs'

    export default {
        components: {
            JetApplicationLogo,
            PortfolioListItem,
            JetDialogModal,
            JetButton,
            JetLabel,
            JetFormSection,
            JetInput,
            JetInputError,
        },
        data(){
            return {
                portfolioItems:[],
                categories:[],
                show:false,
                anotherShow:false,
                defaultImage: null,
                newPort:{
                    image:'',
                    title:'',
                    content:'',
                    category:'',
                    link:'',
                    completion:'',
                }

            }
        },
        methods:{
            addImage(e){
                let files = e.target.files
                let reader = new FileReader()
                if (files && files.length > 0) {
                    reader.readAsDataURL(files[0])
                    const done = (url)=>{
                        document.getElementById('preview_image').src = url
                        this.defaultImage = url
                        this.anotherShow = true
                        Bus.$emit('shown')
                    }
                    reader.onload = e => {
                        done(e.target.result)
                    }
                }


            },

            destroy(){
                Bus.$emit('destroy')
            },
            save(){
                Bus.$emit('save')
            },
            async getPortfolios(){
                try {
                    const res = await axios.get('/api/portfolio')
                    if (res.status === 200) {
                        this.portfolioItems = res.data
                    }
                } catch (err) {
                    Toast.fire({
                        title:'Error!',
                        text:err.message,
                        icon:'error'
                    })
                }
            },
            async getCategories(){
                try {
                    const res = await axios.get('/api/categories')
                    if (res.status === 200) {
                        this.categories = res.data
                    }
                } catch (err) {
                    Toast.fire({
                        title:'Error!',
                        text:err.message,
                        icon:'error'
                    })
                }
            },
            async uploadPortfolio(){
                const form = new FormData;
                    form.append('image', this.newPort.image)
                    form.append('title', this.newPort.title)
                    form.append('content', this.newPort.content)
                    form.append('category', this.newPort.category)
                    form.append('link', this.newPort.link)
                    form.append('completion', this.newPort.completion)
                try {
                    const res = await axios.post('/api/portfolio', form, {'content-type': 'multipart/form-data'})

                    if (res.status === 200) {
                        Bus.$emit('uploaded')
                        console.log(res)
                        this.show = false
                        Toast.fire({
                            title:'Success!',
                            text:res.data,
                            icon:'success'
                        })
                    } else{
                        Toast.fire({
                            title:'Warning!',
                            text: res.data,
                            icon:'warning'
                        })

                    }
                } catch (err) {

                    console.log(err)
                    for (const key in err.response.data.errors) {
                        if (Object.hasOwnProperty.call(err.response.data.errors, key)) {
                            const element = err.response.data.errors[key];
                            Toast.fire({
                                title:'Error!',
                                text:element,
                                icon:'error'
                            })

                        }
                    }
                }
            }

        },

        created(){
            console.log('created')
            this.getPortfolios()
            this.getCategories()

            Bus.$on('uploaded', ()=>{
                this.getPortfolios()
                this.getCategories()
            })

            Bus.$on('shown', ()=>{
                let image = document.getElementById('cropping_image')
                image.src = this.defaultImage

                let cropper = new Cropper(image, {
                    aspectRatio: 16/9,
                    viewMode: 3,
                })

                Bus.$on('save', ()=>{
                    let canvas = cropper.getCroppedCanvas({
                        width:480,
                        height:270
                    })
                    let reader = new FileReader

                    canvas.toBlob(blob=>{

                        let file = new File(blob, 'image', {
                            type:'image/*'
                        })
                        console.log(file)
                        reader.readAsDataURL(blob)
                        reader.onloadend= e => {
                            document.getElementById('preview_image').src = e.target.result
                        }
                        this.anotherShow = false
                        cropper.destroy()
                    })
                })


                Bus.$on('destroy', ()=>{
                    this.anotherShow = false
                    cropper.destroy()
                    this.defaultImage = null
                    image.src = this.defaultImage
                    document.getElementById('preview_image').src = '/images/portfolio/default.jpg'
                })
            })

        }
    }
</script>
