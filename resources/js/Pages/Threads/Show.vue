<template>
    <Header />
    <div class="container">

        <!-- Exibe mensagens de flash -->
        <FlashMessage :flash="flash" />

        <a href="/threads" class="btn-return">Voltar</a>

        <h2 class="page-title">{{ thread.title }}</h2>
        <hr class="divider" />

        <!-- Exibindo os detalhes de um thread -->
        <div class="thread-card">
            <!-- Cabeçalho com "Criado por" -->
            <div class="thread-header">
                <small>Criado por: {{ thread.user.name }} em {{ formatarData(thread.updated_at) }}</small>
            </div>

            <!-- Corpo do card com o título e conteúdo -->
            <div class="thread-body">
                <p class="thread-content">{{ thread.body }}</p>
            </div>

            <!-- Rodapé com "Atualizado em" -->
            <div class="thread-footer">
                <Link :href="`/threads/edit/${thread.slug}`" class="btn-primary">Editar</Link>
                <button @click="deleteThread(thread.slug)" class="btn-danger">Deletar</button>
            </div>
        </div>

        <div class="container-respostas">
            <h3>Respostas:</h3>

            <ul v-if="replies.length > 0" class="replies-list">
                <li v-for="reply in replies" :key="reply.id" class="index-replies-card">
                    <p class="reply-content">{{ reply.reply }}</p>
                    <hr class="divider" />
                    <div class="reply-card">
                        <small>Respondido por: {{ reply.user.name }} em {{ formatarData(reply.created_at) }}</small>
                    </div>
                </li>
            </ul>

            <p v-else class="no-replies-message">Ninguém respondeu a esse tópico ainda.</p>
        </div>

    </div>

    <div class="container-reply">
        <hr class="divider" />

        <form @submit.prevent="submit" class="form-container">

            <div class="form-field">
                <label for="reply" class="label">Responder:</label>
                <textarea v-model="form.reply" id="reply" cols="10" rows="5" class="textarea-field"
                    placeholder="Insira sua resposta"></textarea>
                <div v-if="form.errors.body" class="error-message">{{ form.errors.body }}</div>

            </div>

            <div class="submit-button-container">
                <button type="submit" class="pagination-button">
                    Enviar
                </button>
            </div>
        </form>
    </div>

</template>

<script>
import Header from '@/Components/Header.vue';
import { useForm } from '@inertiajs/vue3';
import FlashMessage from '@/Components/FlashMessage.vue';

export default {
    props: {
        thread: Object,
        replies: Array,
        flash: Object
    },
    components: {
        Header,
        FlashMessage
    },
    methods: {
        formatarData(dataHora) {
            const createdAt = new Date(dataHora);
            return createdAt.toLocaleDateString();
        },
        async deleteThread(slug) {
            if (confirm("Você tem certeza que deseja excluir este tópico?")) {
                try {
                    await axios.delete(`/threads/destroy/${slug}`);
                    window.location.href = '/threads';
                } catch (error) {
                    console.error(error);
                    window.location.href = '/threads';
                }
            }
        },
    },
    setup(props) {
        const form = useForm({
            reply: '',
            thread_id: props.thread.id,
        });

        const submit = () => {
            form.post(route('replies.store'), {
                preserveScroll: true,
                onSuccess: () => {
                    form.reply = '';
                },
            });
        };

        return { form, submit };
    },
}
</script>


<style scoped>
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem 1.5rem;
}

.page-title {
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 1rem;
}

.divider {
    border-top: 1px solid #ddd;
    margin-bottom: 2rem;
}

.btn-return {
    display: inline-block;
    background-color: #3498db;
    color: white;
    padding: 0.5rem 1rem;
    text-decoration: none;
    border-radius: 5px;
    margin-bottom: 2rem;
    font-weight: bold;
}

.btn-return:hover {
    background-color: #2980b9;
}

.thread-card {
    background-color: white;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 1.5rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.thread-header small {
    color: #777;
}

.thread-body {
    margin-top: 1.5rem;
}

.thread-content {
    font-size: 1rem;
    color: #333;
    line-height: 1.6;
}

.thread-footer {
    margin-top: 2rem;
    display: flex;
    justify-content: space-between;
}

.index-replies-card {
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    padding: 1rem;
    margin-bottom: 1rem;
    border-radius: 8px;
}

.reply-card small {
    color: #777;
    font-size: 0.9rem;
}

.reply-content {
    font-size: 1rem;
    color: #333;
    margin-top: 1rem;
}

.no-replies-message {
    font-size: 1rem;
    color: #777;
}

.btn-primary {
    background-color: #27ae60;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 5px;
    font-weight: bold;
    text-decoration: none;
}

.btn-primary:hover {
    background-color: #2ecc71;
}

.btn-danger {
    background-color: #e74c3c;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 5px;
    font-weight: bold;
    cursor: pointer;
    border: none;
}

.btn-danger:hover {
    background-color: #c0392b;
}
</style>
