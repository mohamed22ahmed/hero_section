<template>
  <div class="welcome-page">
    <HeroSection />
    
    <main class="main-content">
      <PromptInput 
        :is-loading="isLoading"
        @submit="handlePromptSubmit"
      />
      
      <ImprovedPrompt 
        v-if="improvedPrompt"
        :improved-prompt="improvedPrompt"
        :metadata="metadata"
        @reset="handleReset"
      />
    </main>
    
    <footer class="page-footer">
      <p class="footer-text">
        Powered by AI • Built with ❤️ using Laravel & Vue.js
      </p>
    </footer>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import HeroSection from '../components/HeroSection.vue';
import PromptInput from '../components/PromptInput.vue';
import ImprovedPrompt from '../components/ImprovedPrompt.vue';

interface Metadata {
  original_word_count: number;
  improved_word_count: number;
  enhancement_type: string;
  suggested_frameworks?: string[];
}

const isLoading = ref(false);
const improvedPrompt = ref('');
const metadata = ref<Metadata | undefined>(undefined);

const handlePromptSubmit = async (prompt: string) => {
  isLoading.value = true;
  
  try {
    const response = await fetch('/api/prompts/improve', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
      },
      body: JSON.stringify({
        original_prompt: prompt,
      }),
    });
    
    const data = await response.json();
    
    if (data.success) {
      improvedPrompt.value = data.data.improved_prompt;
      metadata.value = data.data.metadata;
      
      // Scroll to the improved prompt
      setTimeout(() => {
        const element = document.querySelector('.improved-prompt-container');
        element?.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }, 100);
    } else {
      alert(data.message || 'Failed to improve prompt. Please try again.');
    }
  } catch (error: any) {
    console.error('Error improving prompt:', error);
    alert('An error occurred while improving your prompt. Please try again.');
  } finally {
    isLoading.value = false;
  }
};

const handleReset = () => {
  improvedPrompt.value = '';
  metadata.value = undefined;
  
  // Scroll back to the top
  window.scrollTo({ top: 0, behavior: 'smooth' });
};
</script>

<style scoped>
.welcome-page {
  min-height: 100vh;
  background: linear-gradient(180deg, #0a0118 0%, #1a0b2e 50%, #0a0118 100%);
  color: #fafafa;
  position: relative;
}

.main-content {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 2rem 4rem;
  display: flex;
  flex-direction: column;
  gap: 3rem;
}

.page-footer {
  padding: 2rem;
  text-align: center;
  border-top: 1px solid rgba(255, 255, 255, 0.1);
  background: rgba(0, 0, 0, 0.2);
}

.footer-text {
  color: rgba(255, 255, 255, 0.5);
  font-size: 0.875rem;
  font-weight: 500;
}

@media (max-width: 768px) {
  .main-content {
    padding: 0 1rem 2rem;
  }
}
</style>
