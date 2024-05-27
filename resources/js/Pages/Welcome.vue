<template>
    <div>
      <Head title="LTMS Portal" />
      <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <Navbar :canLogin="canLogin" :canRegister="canRegister" />

        <main class="mt-6 flex flex-col items-center justify-center">
          <div class="mb-4">
            <img id="animated-img" src="../Components/lto.png" alt="LTMS Logo" class="h-48">
          </div>
          <div>
            <h1 id="animated-h1" class="animated-h1">LTMS Portal</h1>
          </div>
        </main>
      </div>
    </div>
  </template>


<script setup>
import { onMounted } from 'vue';
import { Head } from '@inertiajs/vue3';
import Navbar from '../Components/Navbar.vue';

defineProps({
  canLogin: {
    type: Boolean,
  },
  canRegister: {
    type: Boolean,
  },
  laravelVersion: {
    type: String,
    required: true,
  },
  phpVersion: {
    type: String,
    required: true,
  },
});

onMounted(() => {
  const img = document.getElementById('animated-img');
  if (img) {
    img.classList.add('animate-pop');
  }

  const h1 = document.getElementById('animated-h1');
  if (h1) {
    h1.classList.add('animate-pop');
  }
});
</script>

<style scoped>
img {
  height: 200px;
  width: 200px;
  opacity: 0;
}

@keyframes pop {
  0% {
    transform: scale(1);
    opacity: 0;
  }
  50% {
    transform: scale(1.2);
    opacity: 1;
  }
  100% {
    transform: scale(1);
    opacity: 1;
  }
}

.animate-pop {
  animation: pop 2s ease-in-out forwards;
}

h1 {
  text-align: center;
  font-size: 600%;
  font-weight: bold;
}
</style>
