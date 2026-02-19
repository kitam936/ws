<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head ,Link} from '@inertiajs/vue3';
import { reactive } from 'vue';
import { router } from '@inertiajs/vue3'
import { useForm ,usePage } from '@inertiajs/vue3'



defineProps({
    errors : Object,

})


const page = usePage();

const form = useForm({
    vendor_id: page.props.old?.vendor_id ?? "",
    vendor_name: page.props.old?.vendor_name ?? null,
    vendor_info: page.props.old?.vendor_info ?? null,

});



const storevendor = () => {
    router.post('/vendors', form)
}

// 戻るボタンの処理
const goBack = () => {
    window.history.back();
};

</script>

<template>
    <Head title="仕入先登録" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">仕入先登録</h2>
            <div class="flex mt-4">
                <div class="">
                    <button
                        type="button"
                        @click="goBack"
                        class="w-40 h-10 ml-2 md:ml-24 text-gray-700 bg-gray-200 border border-gray-300 focus:outline-none hover:bg-gray-300 rounded text-ml">
                        戻る
                    </button>
                </div>
                <div class="ml-2 md:ml-24 mb-0">
                    <Link as="button" :href="route('vendors.index')" class="w-40 h-10 bg-indigo-500 text-sm text-white ml-0 hover:bg-indigo-600 rounded">仕入先一覧</Link>
                </div>
            </div>
        </template>

        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-2 text-gray-900">
                        <section class="text-gray-600 body-font relative">

                            <form @submit.prevent="storevendor" >
                            <div class="container px-5 py-2 mx-auto">
                                <div class="lg:w-1/2 md:w-2/3 mx-auto">
                                <div class="flex flex-wrap -m-2">


                                    <div class="ml-2 w-full">
                                        <div class="relative">
                                            <label for="vendor_id" class="leading-7 text-sm text-gray-600">仕入先ID</label>
                                            <input type="text" id="vendor_id" name="vendor_id" v-model="form.vendor_id" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            <div v-if="errors.vendor_id" class="text-red-500">{{ errors.vendor_id }}</div>
                                        </div>
                                        <div class="relative">
                                            <label for="vendor_name" class="leading-7 text-sm text-gray-600">仕入先名</label>
                                            <input type="text" id="vendor_name" name="vendor_name" v-model="form.vendor_name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            <div v-if="errors.vendor_name" class="text-red-500">{{ errors.vendor_name }}</div>
                                        </div>
                                    </div>
                                    <div class="flex ml-2 w-full">


                                    </div>
                                    <div class="ml-2 w-full">
                                    <div class="relative">
                                        <label for="vendor_info" class="leading-7 text-sm text-gray-600">詳細</label>
                                        <textarea id="vendor_info" name="vendor_info"  v-model="form.vendor_info" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                                        <div v-if="errors.vendor_info" class="text-red-500">{{ errors.vendor_info }}</div>
                                    </div>
                                    </div>

                                </div>


                                    <div class="ml-2 mt-4 mb-12 w-full">
                                        <button class="w-40 h-10 flex mx-auto text-white bg-pink-500 border-0 py-2 pl-16 focus:outline-none hover:bg-pink-600 rounded text-sm"> 登録</button>
                                    </div>


                                </div>
                            </div>
                            </form>

                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
