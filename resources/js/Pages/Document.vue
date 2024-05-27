<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

const documents = ref([]);
const showModal = ref(false);
const currentDocument = ref({});

function loadDocuments() {
    const storedDocuments = localStorage.getItem('documents');
    if (storedDocuments) {
        documents.value = JSON.parse(storedDocuments);
    } else {
        documents.value = [
            { id: 1, title: 'Driver\'s License', issuedDate: '2023-01-15', expiryDate: '2028-01-15' },
            { id: 2, title: 'Vehicle Registration', issuedDate: '2022-07-10', expiryDate: '2023-07-10' },
            { id: 3, title: 'Insurance Certificate', issuedDate: '2023-05-20', expiryDate: '2024-05-20' }
        ];
        saveDocuments();
    }
}

function saveDocuments() {
    localStorage.setItem('documents', JSON.stringify(documents.value));
}

function editDocument(document) {
    currentDocument.value = { ...document };
    showModal.value = true;
}

function createDocument() {
    currentDocument.value = { id: null, title: '', issuedDate: '', expiryDate: '' };
    showModal.value = true;
}

function saveDocument() {
    if (currentDocument.value.id === null) {
        currentDocument.value.id = documents.value.length ? Math.max(...documents.value.map(doc => doc.id)) + 1 : 1;
        documents.value.push({ ...currentDocument.value });
    } else {
        const index = documents.value.findIndex(doc => doc.id === currentDocument.value.id);
        if (index !== -1) {
            documents.value[index] = { ...currentDocument.value };
        }
    }
    saveDocuments();
    showModal.value = false;
}

function deleteDocument(id) {
    documents.value = documents.value.filter(document => document.id !== id);
    saveDocuments();
}

onMounted(loadDocuments);
</script>


<template>
    <Head title="LTMS Portal" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-white leading-tight">Documents</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex justify-between mb-4">
                            <h3 class="text-2xl font-bold">Documents</h3>
                            <button @click="createDocument" class="bg-blue-500 text-white py-2 px-4 rounded">Create</button>
                        </div>
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b">Title</th>
                                    <th class="py-2 px-4 border-b">Issued Date</th>
                                    <th class="py-2 px-4 border-b">Expiry Date</th>
                                    <th class="py-2 px-4 border-b">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="document in documents" :key="document.id">
                                    <td class="py-2 px-4 border-b">{{ document.title }}</td>
                                    <td class="py-2 px-4 border-b">{{ document.issuedDate }}</td>
                                    <td class="py-2 px-4 border-b">{{ document.expiryDate }}</td>
                                    <td class="py-2 px-4 border-b">
                                        <button @click="editDocument(document)" class="bg-green-500 text-white py-1 px-2 rounded ml-2">Edit</button>
                                        <button @click="deleteDocument(document.id)" class="bg-red-500 text-white py-1 px-2 rounded ml-2">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="showModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                <h3 class="text-2xl mb-4">{{ currentDocument.id ? 'Edit' : 'Create' }} Document</h3>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">Title</label>
                    <input v-model="currentDocument.title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" type="text" placeholder="Title">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="issuedDate">Issued Date</label>
                    <input v-model="currentDocument.issuedDate" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="issuedDate" type="date">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="expiryDate">Expiry Date</label>
                    <input v-model="currentDocument.expiryDate" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="expiryDate" type="date">
                </div>
                <div class="flex items-center justify-between">
                    <button @click="saveDocument" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Save</button>
                    <button @click="showModal = false" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Cancel</button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>



