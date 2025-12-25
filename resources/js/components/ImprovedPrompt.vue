<template>
  <div class="improved-prompt-container">
    <div class="result-header">
      <h3 class="result-title">✨ Your Enhanced Prompt</h3>
      <button @click="handleCopy" class="copy-button" :class="{ copied: isCopied }">
        <svg v-if="!isCopied" class="icon" viewBox="0 0 20 20" fill="currentColor">
          <path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" />
          <path d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z" />
        </svg>
        <svg v-else class="icon" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
        </svg>
        {{ isCopied ? 'Copied!' : 'Copy' }}
      </button>
    </div>

    <div class="prompt-display">
      <div class="prompt-content">
        <pre class="prompt-text">{{ improvedPrompt }}</pre>
      </div>
    </div>

    <div class="metadata-section" v-if="metadata">
      <div class="metadata-item">
        <span class="metadata-label">Original:</span>
        <span class="metadata-value">{{ metadata.original_word_count }} words</span>
      </div>
      <div class="metadata-item">
        <span class="metadata-label">Enhanced:</span>
        <span class="metadata-value">{{ metadata.improved_word_count }} words</span>
      </div>
      <div class="metadata-item">
        <span class="metadata-label">Type:</span>
        <span class="metadata-value">{{ metadata.enhancement_type }}</span>
      </div>
    </div>

    <button @click="handleReset" class="reset-button">
      <svg class="icon" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
      </svg>
      Try Another Idea
    </button>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';

interface Metadata {
  original_word_count: number;
  improved_word_count: number;
  enhancement_type: string;
  suggested_frameworks?: string[];
}

const props = defineProps<{
  improvedPrompt: string;
  metadata?: Metadata;
}>();

const emit = defineEmits<{
  reset: [];
}>();

const isCopied = ref(false);

const handleCopy = async () => {
  try {
    await navigator.clipboard.writeText(props.improvedPrompt);
    isCopied.value = true;
    setTimeout(() => {
      isCopied.value = false;
    }, 2000);
  } catch (err) {
    console.error('Failed to copy:', err);
  }
};

const handleReset = () => {
  emit('reset');
};
</script>

<style scoped>
.improved-prompt-container {
  width: 100%;
  max-width: 900px;
  margin: 0 auto;
  animation: slideUp 0.5s ease-out;
}

@keyframes slideUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.result-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1.5rem;
  gap: 1rem;
}

.result-title {
  font-size: 1.5rem;
  font-weight: 700;
  color: #fafafa;
  margin: 0;
  letter-spacing: -0.02em;
}

.copy-button {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  background: rgba(255, 255, 255, 0.1);
  border: 1px solid rgba(255, 255, 255, 0.2);
  color: #fafafa;
  padding: 0.625rem 1.25rem;
  border-radius: 10px;
  font-size: 0.875rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
}

.copy-button:hover {
  background: rgba(255, 255, 255, 0.15);
  border-color: rgba(255, 255, 255, 0.3);
  transform: translateY(-1px);
}

.copy-button.copied {
  background: rgba(0, 217, 255, 0.2);
  border-color: rgba(0, 217, 255, 0.5);
  color: #00d9ff;
}

.icon {
  width: 18px;
  height: 18px;
}

.prompt-display {
  background: rgba(255, 255, 255, 0.05);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 20px;
  padding: 2rem;
  margin-bottom: 1.5rem;
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
}

.prompt-content {
  max-height: 500px;
  overflow-y: auto;
  scrollbar-width: thin;
  scrollbar-color: rgba(180, 90, 255, 0.5) rgba(255, 255, 255, 0.05);
}

.prompt-content::-webkit-scrollbar {
  width: 8px;
}

.prompt-content::-webkit-scrollbar-track {
  background: rgba(255, 255, 255, 0.05);
  border-radius: 10px;
}

.prompt-content::-webkit-scrollbar-thumb {
  background: rgba(180, 90, 255, 0.5);
  border-radius: 10px;
}

.prompt-content::-webkit-scrollbar-thumb:hover {
  background: rgba(180, 90, 255, 0.7);
}

.prompt-text {
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
  font-size: 0.9375rem;
  line-height: 1.8;
  color: rgba(255, 255, 255, 0.95);
  white-space: pre-wrap;
  word-wrap: break-word;
  margin: 0;
}

.metadata-section {
  display: flex;
  gap: 2rem;
  padding: 1.25rem;
  background: rgba(0, 217, 255, 0.05);
  border: 1px solid rgba(0, 217, 255, 0.2);
  border-radius: 12px;
  margin-bottom: 1.5rem;
  flex-wrap: wrap;
}

.metadata-item {
  display: flex;
  flex-direction: column;
  gap: 0.25rem;
}

.metadata-label {
  font-size: 0.75rem;
  color: rgba(255, 255, 255, 0.5);
  text-transform: uppercase;
  letter-spacing: 0.05em;
  font-weight: 600;
}

.metadata-value {
  font-size: 1rem;
  color: #00d9ff;
  font-weight: 600;
}

.reset-button {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
  width: 100%;
  background: rgba(255, 255, 255, 0.05);
  border: 2px solid rgba(255, 255, 255, 0.1);
  color: #fafafa;
  padding: 1rem 2rem;
  border-radius: 12px;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
}

.reset-button:hover {
  background: rgba(255, 255, 255, 0.1);
  border-color: rgba(255, 255, 255, 0.2);
  transform: translateY(-2px);
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

@media (max-width: 768px) {
  .result-header {
    flex-direction: column;
    align-items: flex-start;
  }

  .copy-button {
    width: 100%;
    justify-content: center;
  }

  .metadata-section {
    gap: 1rem;
  }

  .prompt-display {
    padding: 1.5rem;
  }
}
</style>
