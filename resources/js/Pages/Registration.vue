<script setup>
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import { ref } from 'vue'

import MultiSelect from 'primevue/multiselect';
import Calendar from 'primevue/calendar';
import InputNumber from 'primevue/inputnumber';
import InputGroup from 'primevue/inputgroup';
import InputGroupAddon from 'primevue/inputgroupaddon';
import axios from 'axios';

const user = usePage().props.auth.user


// form data
const fullname = ref(user.name)
const position = ref('')
const telephone = ref(null)
const email = ref(user.email)
const bornYear = ref('')
const skillSets = ref([])

// reset data after submit
const resetData = () => {
    fullname.value = ''
    position.value = ''
    telephone.value = null
    email.value = ''
    bornYear.value = ''
    skillSets.value = ''
}



// data props
const props = defineProps({
    jobs: Array,
    skills: Array
})

// function for registration
const Registration = () => {
    const formData = {
        fullname: fullname.value,
        position: position.value,
        telephone: telephone.value,
        email: email.value,
        bornYear: bornYear.value,
        skill_sets: skillSets.value.map(skill => skill.id)
    };

    axios.post('/api/registration/store', formData)
        .then(function (response) {
            Swal.fire({
                    title: 'Berhasil',
                    text: response.data.message,
                    icon: 'success',
                });
        })
        .catch(function (error) {
            if (error.response && error.response.data && error.response.data.errors) {
                var concatenatedErrorMessages = ""
                Object.keys(error.response.data.errors).forEach(function (key) {
                    var errorArray = error.response.data.errors[key]
                    if (Array.isArray(errorArray)) {
                        concatenatedErrorMessages += errorArray.join('\n') + '\n'
                    } else {
                        concatenatedErrorMessages += errorArray + '\n'
                    }
                });
                Swal.fire({
                    title: 'Terjadi Kesalahan',
                    text: concatenatedErrorMessages,
                    icon: 'warning',
                })
            } else {
                Swal.fire({
                    title: 'Terjadi Kesalahan',
                    text: 'An unexpected error occurred.',
                    icon: 'error',
                });
            }
        })
}
</script>

<template>

    <Head title="Welcome" />

    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 selection:bg-red-500 selection:text-white">


        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="flex justify-center">
                <img class="w-[240px]" src="/assets/img/energeek.png" alt="energeek">
            </div>

            <div class="mt-10">
                <div class="bg-white rounded-xl w-[400px] py-2">
                    <form action="/api/registration/store" method="POST" @submit.prevent="Registration()">
                        <div class="flex flex-col m-5 gap-2">
                            <label for="name" class="text-md font-semibold text-gray-700 ">Nama Lengkap</label>
                            <input type="text" v-model="fullname"
                                class="text-gray-500 placeholder:text-gray-300 rounded-md border border-gray-300 focus:ring-gray-300 focus:border-gray-400"
                                placeholder="Cth: Jhonatan Akbar">
                        </div>

                        <div class="flex flex-col m-5 gap-2">
                            <label for="name" class="text-md font-semibold text-gray-700 ">Jabatan</label>
                            <select v-model="position"
                                class="text-gray-500 placeholder:text-gray-300 rounded-md border border-gray-300 focus:ring-gray-300 focus:border-gray-400"
                                placeholder="Cth: Jhonatan Akbar">
                                <option value="" selected disabled>Pilih Jabatan</option>
                                <template v-for="job in props.jobs" :key="job.id">
                                    <option :value="job.id">{{ job.name }}</option>
                                </template>
                            </select>

                        </div>
                        <div class="flex flex-col m-5 gap-2">
                            <label for="name" class="text-md font-semibold text-gray-700 ">Telepon</label>
                            <InputGroup>
                                <InputGroupAddon class="border border-gray-300">+62</InputGroupAddon>
                                <InputNumber v-model="telephone"
                                    class="text-gray-500 placeholder:text-gray-300  focus:ring-gray-300 focus:border-gray-400"
                                    inputId="withoutgrouping" :useGrouping="false" placeholder="Cth: 893239851289" />
                            </InputGroup>
                        </div>
                        <div class="flex flex-col m-5 gap-2">
                            <label for="name" class="text-md font-semibold text-gray-700 ">Email</label>
                            <input type="email" v-model="email"
                                class="text-gray-500 placeholder:text-gray-300 rounded-md border border-gray-300 focus:ring-gray-300 focus:border-gray-400"
                                placeholder="Cth: energeekmail@gmail.com">
                        </div>
                        <div class="m-5">
                            <label for="name" class="text-md font-semibold text-gray-700 ">Tahun Lahir</label>
                            <div class="mt-2">
                                <Calendar v-model="bornYear" view="year" dateFormat="yy" showIcon iconDisplay="input"
                                    class="w-full" placeholder="Pilih Tahun" />

                            </div>
                        </div>
                        <div class="m-5">
                            <label for="name" class="text-md font-semibold text-gray-700 ">Skill Set</label>
                            <div class="mt-2">
                                <MultiSelect v-model="skillSets" display="chip" :options="props.skills"
                                    optionLabel="name" placeholder="Pilih skill" :maxSelectedLabels="3"
                                    class="w-full border border-gray-300 rounded-md" />
                            </div>
                        </div>
                        <div class="m-5">
                            <button type="submit"
                                class="w-full bg-pink-400 py-2 rounded-md text-white font-semibold">Apply</button>
                        </div>
                    </form>
                    <div class="m-5">
                        <Link as="button" type="submit" :href="route('logout')" method="post"
                            class="w-full bg-red-400 py-2 rounded-md text-white font-semibold">Logout</Link>
                    </div>
                </div>
            </div>


        </div>
    </div>
</template>

<style>
.p-inputtext {
    border: 1px solid #ccc;
    border-radius: 0.375rem;
    color: #4b5563;
}

.p-inputtext:focus {
    border-color: #9ca3af;
    box-shadow: #9ca3af;
}

.p-inputtext::placeholder {
    color: #d1d5db;
}
</style>
