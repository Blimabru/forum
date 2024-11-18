<template>
    <nav class="navbar">
        <div class="container">
            <!-- Nome ou Logo -->
            <div>
                <Link href="/threads" class="logo">Fórum</Link>
            </div>

            <!-- Links de Navegação -->
            <div>
                <ul class="nav-links">
                    <li>
                        <Link href="/login" class="nav-link">Entrar</Link>
                    </li>
                    <li>
                        <a href="/register" class="nav-link">Cadastro</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
    name: "Header",
};
</script>

<style scoped>
.navbar {
    background-color: #2d3748;
    color: white;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 1rem;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo {
    font-size: 1.25rem;
    font-weight: bold;
    transition: color 0.3s;
}

.logo:hover {
    color: #cbd5e0;
}

.nav-links {
    display: flex;
    gap: 1rem;
}

.nav-link {
    transition: color 0.3s;
}

.nav-link:hover {
    color: #cbd5e0;
}
</style>
