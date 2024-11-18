<template>
    <Header />
    <div class="container">
        <!-- Título do formulário -->
        <h1 class="form-heading">Criar Novo Thread</h1>

        <!-- Formulário de criação de thread -->
        <form @submit.prevent="submit" class="form-container">

            <!-- Campo para o título do thread -->
            <div class="form-field">
                <label for="title" class="label">Título</label>
                <input v-model="form.title" type="text" id="title" class="input-field"
                    placeholder="Digite o título do thread" />
                <div v-if="form.errors.title" class="error-message">{{ form.errors.title }}</div>
            </div>

            <!-- Campo para o conteúdo do thread -->
            <div class="form-field">
                <label for="body" class="label">Conteúdo</label>
                <textarea v-model="form.body" id="body" rows="6" class="textarea-field"
                    placeholder="Digite o conteúdo do thread"></textarea>
                <div v-if="form.errors.body" class="error-message">{{ form.errors.body }}</div>
            </div>

            <!-- Botão para enviar o formulário -->
            <div class="submit-button-container">
                <button type="submit" class="pagination-button">
                    Salvar
                </button>
            </div>
        </form>
    </div>
</template>

<script>
import Header from '@/Components/Header.vue';
import { useForm } from '@inertiajs/vue3';

export default {
    components: {
        Header
    },
    setup() {
        const form = useForm({
            title: '',
            body: '',
        });

        const submit = () => {
           form.post('/threads');
        };

        return { form, submit };
    },
};
</script>

<style scoped>
/* Estilização para o container principal */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding-left: 1.5rem;
    padding-right: 1.5rem;
    padding-top: 2rem;
}

/* Estilização para o título do formulário */
.form-heading {
    font-size: 1.875rem;
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 1.5rem;
}

/* Estilização para o formulário */
.form-container {
    background-color: white;
    padding: 2rem;
    border-radius: 0.375rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Estilização para cada campo do formulário */
.form-field {
    margin-bottom: 1.5rem;
}

/* Estilização para os rótulos de cada campo */
.label {
    font-size: 0.875rem;
    font-weight: 500;
    color: #4a5568;
    margin-bottom: 0.5rem;
}

/* Estilização para os campos de entrada de texto */
.input-field, .textarea-field {
    width: 100%;
    padding: 0.75rem;
    font-size: 1rem;
    border: 1px solid #e2e8f0;
    border-radius: 0.375rem;
    background-color: #f7fafc;
    color: #4a5568;
}

/* Estilização para as mensagens de erro */
.error-message {
    color: #e53e3e;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

/* Estilização para o botão de envio */
.submit-button-container {
    text-align: center;
}

.pagination-button {
    background-color: #4caf50;
    color: white;
    padding: 0.75rem 1.5rem; 
    font-size: 1rem;
    border-radius: 0.375rem;
    border: none;
    cursor: pointer;
    transition: background-color 0.2s;
}

.pagination-button:hover {
    background-color: #45a049;
}
</style>
