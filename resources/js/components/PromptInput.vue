<template>
  <div class="prompt-input-container">
    <div class="input-wrapper">
      <label for="prompt-input" class="input-label">
        What's your website idea?
      </label>
      <textarea
        id="prompt-input"
        v-model="localPrompt"
        :disabled="isLoading"
        class="prompt-textarea"
        placeholder="E.g., 'A recipe app where users can share their favorite dishes' or 'An online store for handmade jewelry'"
        rows="6"
        @input="handleInput"
      ></textarea>
      <div class="input-footer">
        <span class="character-count" :class="{ 'count-warning': isNearLimit }">
          {{ characterCount }} / 1000
        </span>
        <button
          @click="handleSubmit"
          :disabled="!canSubmit"
          class="submit-button"
        >
          <span v-if="!isLoading" class="button-content">
            <svg class="button-icon" viewBox="0 0 20 20" fill="currentColor">
              <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
            </svg>
            Improve My Idea
          </span>
          <span v-else class="button-content">
            <span class="loading-spinner"></span>
            Processing...
          </span>
        </button>
      </div>
    </div>
    <p v-if="errorMessage" class="error-message">{{ errorMessage }}</p>
  </div>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue';

const props = defineProps<{
  isLoading: boolean;
}>();

const emit = defineEmits<{
  submit: [prompt: string];
}>();

const localPrompt = ref('');
const errorMessage = ref('');

const characterCount = computed(() => localPrompt.value.length);
const isNearLimit = computed(() => characterCount.value > 900);
const canSubmit = computed(() => {
  const count = characterCount.value;
  return count >= 10 && count <= 1000 && !props.isLoading;
});

const handleInput = () => {
  errorMessage.value = '';
};

const handleSubmit = () => {
  if (!canSubmit.value) {
    if (characterCount.value < 10) {
      errorMessage.value = 'Please enter at least 10 characters.';
    } else if (characterCount.value > 1000) {
      errorMessage.value = 'Please keep your idea under 1000 characters.';
    }
    return;
  }
  
  errorMessage.value = '';
  emit('submit', localPrompt.value);
};
</script>

<style scoped>
.prompt-input-container {
  width: 100%;
  max-width: 800px;
  margin: 0 auto;
}

.input-wrapper {
  background: rgba(255, 255, 255, 0.05);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 20px;
  padding: 2rem;
  transition: all 0.3s ease;
}

.input-wrapper:focus-within {
  border-color: rgba(180, 90, 255, 0.5);
  box-shadow: 0 8px 32px rgba(180, 90, 255, 0.2);
  transform: translateY(-2px);
}

.input-label {
  display: block;
  font-size: 1.25rem;
  font-weight: 600;
  color: #fafafa;
  margin-bottom: 1rem;
  letter-spacing: -0.02em;
}

.prompt-textarea {
  width: 100%;
  background: rgba(255, 255, 255, 0.03);
  border: 2px solid rgba(255, 255, 255, 0.1);
  border-radius: 12px;
  padding: 1rem;
  font-size: 1rem;
  color: #fafafa;
  font-family: 'Inter', sans-serif;
  line-height: 1.6;
  resize: vertical;
  transition: all 0.3s ease;
}

.prompt-textarea:focus {
  outline: none;
  border-color: rgba(180, 90, 255, 0.6);
  background: rgba(255, 255, 255, 0.05);
}

.prompt-textarea::placeholder {
  color: rgba(255, 255, 255, 0.4);
}

.prompt-textarea:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

.input-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 1rem;
  gap: 1rem;
}

.character-count {
  font-size: 0.875rem;
  color: rgba(255, 255, 255, 0.5);
  font-family: 'Courier New', monospace;
  transition: color 0.3s ease;
}

.count-warning {
  color: #ff9800;
}

.submit-button {
  background: linear-gradient(135deg, #b45aff 0%, #ff5aaf 100%);
  color: white;
  border: none;
  padding: 0.875rem 2rem;
  border-radius: 12px;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  box-shadow: 0 4px 15px rgba(180, 90, 255, 0.3);
}

.submit-button:hover:not(:disabled) {
  transform: translateY(-2px);
  box-shadow: 0 6px 25px rgba(180, 90, 255, 0.5);
}

.submit-button:active:not(:disabled) {
  transform: translateY(0);
}

.submit-button:disabled {
  opacity: 0.5;
  cursor: not-allowed;
  transform: none;
}

.button-content {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  justify-content: center;
}

.button-icon {
  width: 20px;
  height: 20px;
}

.loading-spinner {
  width: 16px;
  height: 16px;
  border: 2px solid rgba(255, 255, 255, 0.3);
  border-top-color: white;
  border-radius: 50%;
  animation: spin 0.8s linear infinite;
}

@keyframes spin {
  to {
    transform: rotate(360deg);
  }
}

.error-message {
  margin-top: 1rem;
  padding: 0.75rem 1rem;
  background: rgba(255, 82, 82, 0.1);
  border: 1px solid rgba(255, 82, 82, 0.3);
  border-radius: 8px;
  color: #ff5252;
  font-size: 0.875rem;
}

@media (max-width: 768px) {
  .input-wrapper {
    padding: 1.5rem;
  }

  .input-footer {
    flex-direction: column;
    align-items: stretch;
  }

  .submit-button {
    width: 100%;
  }
}
</style>
