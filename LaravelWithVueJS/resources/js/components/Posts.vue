<template>
    <div class="max-w-4xl mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6">Posts</h1>

        <form class="mb-6 bg-white p-4 shadow-md rounded-md" @submit.prevent="savePost" enctype="multipart/form-data">


            <div class="mb-4">
                <input type="text" v-model="form.title" placeholder="Tittle"
                    class="w-full p-2 border border-gray-300 focus:outline:none focus:ring focus:ring-indigo-300"></input>
            </div>



            <div class="mb-4">
                <textarea placeholder="Content" v-model="form.content"
                    class="w-full p-2 border border-gray-300 focus:outline:none focus:ring focus:ring-indigo-300"></textarea>
            </div>


            <!-- <input type="file" @change="handleFileUpload" ref="imagefile" class="w-full p-2"></input>-->



            <div class="mb-4">
                <label for="fileInput"
                    class="block w-full cursor-pointer bg-gray-100 border border-gray-300 p-2 text-gray-700 rounded hover:bg-gray-200">
                    {{ form.image ? form.image.name : "Choose Image" }}
                </label>
                <input id="fileInput" type="file" @change="handleFileUpload" ref="imagefile" class="hidden" />
            </div>


            <!-- Image Preview -->
            <div>
                <div v-if="imagePreview" class="mt-4">
                    <p class="text-sm text-gray-500">Preview:</p>
                    <img :src="imagePreview" alt="Image Preview" class="w-48 rounded shadow my-2 mx-2" />
                </div>
            </div>



            <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600">{{ editMode
                ?
                "Update" : "Create" }}</button>

        </form>


        <div v-for="post in posts.data" :key="post.id" class="mb-4 bg-white p-4 shadow-md rounded-md">
            <h3 class="text-xl font-semibold">{{ post.title }}</h3>
            <p class="text-gray-700">{{ post.content }}</p>

            <img v-if="post.image" :src="'/storage/' + post.image"
                class="w-60 h-40 object-cover rounded-lg shadow"></img>

            <button type="button" class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 mt-3"
                @click="editPost(post)">Edit</button>
            <button type="button" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 mt-3 ml-2"
                @click="deletePost(post.id)">Delete</button>
        </div>


        <!-- pagination -->

        <div v-if="posts.links" class="flex justify-center items-center space-x-2 mt-6">
            <button v-for="(link, index) in posts.links" :key="index" @click="fetchPosts(link.url)"
                :disabled="!link.url" class="px-4 py-2 rounded-md " :class="{
                    'bg-indigo-500 text-white hover:bg-indigo-600': link.active,
                    'bg-gray-500 text-white hover:bg-gray-600': !link.active && link.url,
                    'bg-gray-300 text-gray-600 cursor-not-allowed': !link.url
                }" v-html="link.label">
            </button>
        </div>
    </div>
</template>

<script>
import { useToast } from "vue-toastification";
import axios from "axios";

export default {
    data() {
        return {
            posts: [],
            form: {
                title: "",
                content: "",
                image: null
            },
            imagePreview: null,
            editMode: false,
            editId: null
        };
    },
    setup() {
        const toast = useToast();
        return { toast };
    },
    methods: {
        async fetchPosts(url = "/api/posts") {
            const { data } = await axios.get(url);
            this.posts = data;
        },
        async savePost() {
            const formData = new FormData();
            formData.append("title", this.form.title);
            formData.append("content", this.form.content);

            if (this.form.image) {
                formData.append("image", this.form.image);
            }

            if (this.editMode) {
                formData.append("_method", "PUT");
                await axios.post(`/api/posts/${this.editId}`, formData, {
                    headers: {
                        "Content-Type": "multipart/form-data"
                    }
                });
                this.toast.success("Post updated successfully!");
                this.editMode = false;
            } else {
                await axios.post("/api/posts", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data"
                    }
                });
                this.toast.success("Post created successfully!");
            }

            this.form = { title: "", content: "", image: null };
            this.$refs.imagefile.value = null;
            this.imagePreview = null;
            this.fetchPosts();
        },

        handleFileUpload(event) {
            const file = event.target.files[0];
            if (file) {
                this.form.image = file;
                this.imagePreview = URL.createObjectURL(file);
            }
        },
        editPost(post) {
            this.form = {
                title: post.title,
                content: post.content
            };
            this.editId = post.id;
            this.editMode = true;
        },
        async deletePost(id) {
            await axios.delete(`/api/posts/${id}`);
            this.toast.success("Post deleted successfully!");
            this.fetchPosts();
        }
    },
    mounted() {
        this.fetchPosts();
    }
};
</script>