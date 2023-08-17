<script>

const API_LINKS = '/api/v1/links'

export default {
    created: function() {
        this.fetchStats();
    },
    data: function() {
        return {
            links: null,
        }
    },
    methods: {
        fetchStats() {
            fetch(API_LINKS)
                .then(res => res.json())
                .then(json => {
                    this.links = json.items;
                });
        },
    },
};
</script>


<template>
<div class="container">
    <table class="table table-striped mt-3">
        <thead>
        <tr>
            <th>Id</th>
            <th>Cсылка</th>
            <th>Количество переходов</th>
        </tr>
        </thead>
        <tbody>
        <tr v-if="links !== undefined" v-for="item in links">
            <td>
                <span v-text="item.id"></span>
            </td>
            <td>
                <span v-text="item.generated_link"></span>
            </td>
            <td>
                <span v-text="item.transitions_count"></span>
            </td>
        </tr>
        </tbody>
    </table>
</div>
</template>
