<template>
    <div class="max-w-4xl mx-auto p-4">
        <h1 class="text-xl font-bold text-blue-900 mb-3">Your jobApplications</h1>
        <p>Total Number Of Jobs You Have Applied For: {{ totalApplicationsCount.job_applications_count }} </p>

        <div v-if="jobApplications.length <= 0" class="text-gray-500 my-10">
            You haven't applied to any jobs yet.
        </div>

        <!-- start table applications  -->
        <div v-else class="my-10">
            <Table>
                <template v-slot:tableHead>
                    <th class="px-4 py-2">
                        Job
                    </th>
                    <th class="px-4 py-2">
                        Company
                    </th>
                    <th class="px-4 py-2">
                        Number Of Applicants
                    </th>
                    <th class="px-4 py-2">
                        Status
                    </th>
                    <th class="px-4 py-2">
                        Applied Data
                    </th>
                </template>

                <template v-slot:tableBody>
                    <tr v-for="application in jobApplications.data" :key="application.id">
                        <th>
                            <Link
                                :class="application.job_post.user.deleted_at ? 'pointer-events-none' : 'text-blue-400'"
                                :href="route('user.jobs.show', { slug: application.job_post.slug })">
                            {{ application.job_post.title }}</Link>
                        </th>
                        <td class="px-4 py-2">
                            <Link
                                :class="application.job_post.user.deleted_at ? 'pointer-events-none' : 'text-blue-400'"
                                :href="route('user.company.show', { user: application.job_post.user.id })">{{
                                    application.job_post.user.company_profile.name }} <span
                                v-if="application.job_post.user.deleted_at" class="text-red-300">(Deleted)</span></Link>
                        </td>
                        <td class="px-4 py-2">
                            {{ application.job_post.job_applications_count }}
                        </td>
                        <td class="px-4 py-2">
                            <JobApplicationStatus :status="application.status" />
                        </td>
                        <td class="px-4 py-2">
                            {{ application.created_at_human }}
                        </td>
                    </tr>
                </template>
            </Table>

            <Pagination :pagination="jobApplications" :baseUrl="route('user.job-applications.index')" />
        </div>
        <!-- end table applications  -->
    </div>

</template>

<script>
// import Layout from '@/Layouts/Layout.vue';
import Table from '@/Components/UI/Table.vue';
import Pagination from '@/Components/Pagination.vue';
import JobApplicationStatus from '@/Components/JobApplicationStatus.vue';
import { route } from 'ziggy-js';


export default {
    components: { Table, Pagination, JobApplicationStatus },
    props: {
        jobApplications: Object,
        totalApplicationsCount: Object,
    },

    mounted() {
        console.log(this.totalApplicationsCount);

    }

}
</script>