<script>
import { useVuelidate } from '@vuelidate/core'
import { required, url, maxLength } from '@vuelidate/validators'

const API_LINKS = '/api/v1/links'

const validateFromServer = getter => function (value) {
    console.log("validateFromServer(%o,%o)",getter, this.validationPromise)
    return this.validationPromise ? this.validationPromise.then(getter) : true
}

export default {
    setup () {
        return { v$: useVuelidate() }
    },
    data: function() {
        return {
            validationPromise: null,
            link: '',
            isSuccess: false,
            loading: false,
            shortLink: ''
        }
    },
    validations () {
        return {
            link: { required, url, maxLength: maxLength(255) },
            serverSaidOK: validateFromServer('link')
        }
    },
    methods: {
        createNew: function () {
            this.loading = true;
            fetch(API_LINKS, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json, text/plain, */*',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(
                    {
                        link: this.link,
                    }
                )
            })
            .then(res => res.json())
            .then(json => {
                if (json.status !== 'success') {
                    this.link = '';
                    this.v$.link.$errors[0].$message = json.error_message !== undefined ? json.error_message : 'Something error!'
                } else {
                    this.isSuccess = true;
                    this.shortLink = json.short_link;
                }
                this.loading = false;
            })
        },
    },
};
</script>


<template>
    <loader v-show="loading"/>
    <div v-if="!isSuccess" class="container mt-3">
        <div class="row col-6">
            <div class="mb-3">
                <div :class="{ error: v$.link.$errors.length }">
                    <input type="url" class="form-control" placeholder="https://example.com" v-model="v$.link.$model">
                    <div class="input-errors mt-3" v-for="(error, index) of v$.link.$errors" :key="index">
                        <div class="error-msg text-danger fw-bold">{{ error.$message }}</div>
                    </div>
                </div>
                <button :disabled="v$.link.$invalid" @click="createNew" type="button" class="btn btn-success mt-3">Сократить</button>
            </div>
        </div>
    </div>
    <div v-if="isSuccess" class="container mt-4">
        <div class="alert alert-success">
            <p>Успешно!</p>
            <p class="mb-0 generated-link">Ваша короткая ссылка: <a target="_blank" :href="this.shortLink"><span>{{ this.shortLink }}</span></a></p>
            <div class="col-4">
                <button type="button" class="btn btn-warning mt-3"><a href="/">Создать другую короткую ссылку</a></button>
            </div>
        </div>
    </div>
</template>

<style>
    .generated-link a {
        color: #0a53be !important;
    }
</style>
