<template>
    <div class="max-w-4xl mx-auto py-10 px-4">
        <h1 class="text-2xl font-bold mb-4">Job Seeker: {{ user.name }}</h1>

        <div class="mb-6">
            <p><strong>Email:</strong> {{ user.email }}</p>
            <p v-if="user.bio"><strong>Bio:</strong> {{ user.bio }}</p>
            <p v-if="user.resume" class="mt-2">
                <strong>Resume:</strong>
                <a :href="user.resume" target="_blank" class="text-blue-600 hover:underline">View Resume</a>
            </p>
        </div>

        <h2 class="text-xl font-semibold mb-2">Applications</h2>
        <div v-if="!user.applications.length" class="text-gray-500">No applications yet.</div>

        <ul v-else class="space-y-2">
            <li v-for="app in user.applications" :key="app.id" class="p-4 border bg-white rounded shadow-sm">
                <h3 class="text-sm text-gray-700">
                    Applied to: <strong>{{ app.job?.title || 'Job Deleted' }}</strong>
                </h3>
                <p class="text-xs text-gray-500">
                    Submitted: {{ formatDate(app.created_at) }}
                </p>
                <p class="mt-2 text-sm text-gray-800 whitespace-pre-line">
                    {{ app.cover_letter }}
                </p>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: {
        user: Object,
    },
    methods: {
        formatDate(date) {
            return new Date(date).toLocaleDateString()
        },
    },
}
</script>