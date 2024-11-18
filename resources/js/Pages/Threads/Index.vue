<template>
    <Header />
    <div class="container">
        <!-- Exibe mensagens de flash -->
        <FlashMessage :flash="flash" />

        <div class="mb-8">
            <h2 class="page-title">Tópicos</h2>
            <hr class="divider" />
        </div>

        <Link href="/threads/create" class="btn-primary">Criar tópico</Link>

        <div class="space-y-6">
            <!-- Verifica se há threads -->
            <ul v-if="threads.length > 0" class="threads-list">
                <li v-for="thread in threads" :key="thread.id" class="index-thread-card">

                    <!-- Ao clicar, redireciona para a página de detalhes do thread -->
                    <Link :href="`/threads/${thread.slug}`" class="thread-title">
                        {{ thread.title }}
                    </Link>

                    <p class="thread-date">Criado em {{ criadoDesde(thread.created_at) }}</p>
                </li>
            </ul>

            <!-- Exibe mensagem caso não haja threads -->
            <p v-else class="no-threads-message">Não há threads disponíveis no momento.</p>
        </div>

        <!-- Paginação e Botões, como antes -->
        <div v-if="pagination && pagination.total > 0" class="pagination-container">
            <button @click="changePage(pagination.current_page - 1)" :disabled="pagination.current_page === 1"
                class="pagination-button">
                Anterior
            </button>

            <span class="pagination-info">
                Página {{ pagination.current_page }} de {{ pagination.last_page }}
            </span>

            <button @click="changePage(pagination.current_page + 1)"
                :disabled="pagination.current_page === pagination.last_page" class="pagination-button">
                Próximo
            </button>
        </div>

        <!-- Botão para criar novo thread -->
        <div class="create-thread-container">
            <Link href="/threads/create" class="create-thread-button">
                Criar Novo Thread
            </Link>
        </div>
    </div>
</template>

<script>
import Header from '@/Components/Header.vue';
import FlashMessage from '@/Components/FlashMessage.vue';

export default {
    props: {
        threads: Array,
        pagination: Object,
        flash: Object
    },
    components: {
        Header,
        FlashMessage
    },
    methods: {
        changePage(page) {
            if (page < 1 || page > this.pagination.last_page) return;

            this.$inertia.get(`/threads?page=${page}`);
        },

        formatarData(dataHora) {
            const createdAt = new Date(dataHora);
            return createdAt.toLocaleDateString();
        },

        criadoDesde(dataHora) {
            const criadoDesde = new Date(dataHora);
            const dataHoraAtual = new Date();

            const intervaloTempoEmSegundos = Math.floor((dataHoraAtual - criadoDesde) / 1000);

            if (intervaloTempoEmSegundos < 60) {
                return `${intervaloTempoEmSegundos} segundos atrás`;
            }

            const intervaloTempoEmMinutos = Math.floor(intervaloTempoEmSegundos / 60);
            if (intervaloTempoEmMinutos < 60) {
                return `${intervaloTempoEmMinutos} minutos atrás`;
            }

            const intervaloTempoEmHoras = Math.floor(intervaloTempoEmMinutos / 60);
            if (intervaloTempoEmHoras < 24) {
                return `${intervaloTempoEmHoras} horas atrás`;
            }

            const intervaloTempoEmDias = Math.floor(intervaloTempoEmHoras / 24);
            if (intervaloTempoEmDias < 30) {
                return `${intervaloTempoEmDias} dias atrás`;
            }

            const intervaloTempoEmMeses = Math.floor(intervaloTempoEmDias / 30);
            if (intervaloTempoEmMeses < 12) {
                return `${intervaloTempoEmMeses} meses atrás`;
            }

            const intervaloTempoEmAnos = Math.floor(intervaloTempoEmMeses / 12);
            return `${intervaloTempoEmAnos} anos atrás`;
        }
    }
}
</script>

<style scoped>
/* Estilização para o container principal */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding-left: 1rem;
    padding-right: 1rem;
    padding-top: 2rem;
}

/* Estilização para o título da página */
.page-title {
    font-size: 1.875rem;
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 1.5rem;
}

/* Estilização para a linha horizontal */
.divider {
    border-top: 1px solid #e2e8f0;
    margin-top: 1rem;
    margin-bottom: 2rem;
}

/* Estilização para a lista de tópicos */
.threads-list {
    list-style-type: none;
    padding-left: 0;
}

/* Estilização para cada item da thread */
.index-thread-card {
    background-color: white;
    padding: 1rem;
    border-radius: 0.375rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.thread-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #2b6cb0;
    text-decoration: none;
}

.thread-title:hover {
    text-decoration: underline;
}

/* Estilização para a data da thread */
.thread-date {
    font-size: 0.875rem;
    color: #718096;
    margin-top: 0.5rem;
}

/* Estilização para a mensagem de ausência de threads */
.no-threads-message {
    font-size: 1rem;
    color: #4a5568;
    text-align: center;
}

/* Estilização para o botão de criar tópico */
.btn-primary {
    background-color: #3182ce;
    color: white;
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
    border-radius: 0.375rem;
    border: none;
    cursor: pointer;
    transition: background-color 0.2s;
}

.btn-primary:hover {
    background-color: #2b6cb0;
}

/* Estilização para os botões de paginação */
.pagination-container {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 2rem;
}

.pagination-button {
    background-color: #edf2f7;
    color: #2d3748;
    padding: 0.5rem 1rem;
    font-size: 1rem;
    border-radius: 0.375rem;
    border: none;
    cursor: pointer;
    transition: background-color 0.2s;
}

.pagination-button:hover {
    background-color: #e2e8f0;
}

.pagination-button:disabled {
    background-color: #edf2f7;
    color: #cbd5e0;
    cursor: not-allowed;
}

/* Estilização para a informação da paginação */
.pagination-info {
    margin: 0 1rem;
    font-size: 1rem;
    color: #4a5568;
}

/* Estilização para o container do botão de criar thread */
.create-thread-container {
    margin-top: 2rem;
    text-align: center;
}

/* Estilização do botão de criação de thread */
.create-thread-button {
    background-color: #38a169;
    color: white;
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
    border-radius: 0.375rem;
    border: none;
    cursor: pointer;
    transition: background-color 0.2s;
}

.create-thread-button:hover {
    background-color: #2f855a;
}
</style>
