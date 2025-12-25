<template>
  <div class="hero-section">
    <div class="hero-content">
      <div class="hero-badge">
        <svg class="badge-icon" viewBox="0 0 20 20" fill="currentColor">
          <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
        </svg>
        AI-Powered Website Prompt Enhancement
      </div>
      
      <h1 class="hero-title">
        Transform Your Ideas into
        <span class="gradient-text">Detailed Prompts</span>
      </h1>
      
      <p class="hero-description">
        Got a rough website idea? Let our AI transform it into a comprehensive, 
        actionable prompt with all the technical details you need to get started.
      </p>
      
      <div class="features-grid">
        <div class="feature-item">
          <div class="feature-icon">⚡</div>
          <span>Lightning Fast</span>
        </div>
        <div class="feature-item">
          <div class="feature-icon">🎯</div>
          <span>Precision Enhanced</span>
        </div>
        <div class="feature-item">
          <div class="feature-icon">🚀</div>
          <span>Production Ready</span>
        </div>
      </div>
    </div>
    
    <div class="animated-background">
      <div class="gradient-orb orb-1"></div>
      <div class="gradient-orb orb-2"></div>
      <div class="gradient-orb orb-3"></div>
    </div>
  </div>
</template>

<script setup lang="ts">
// No props or emits needed for this static component
</script>

<style scoped>
.hero-section {
  position: relative;
  width: 100%;
  padding: 4rem 2rem;
  overflow: hidden;
  margin-bottom: 3rem;
}

.hero-content {
  position: relative;
  z-index: 2;
  max-width: 800px;
  margin: 0 auto;
  text-align: center;
}

.hero-badge {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.5rem 1.25rem;
  background: rgba(180, 90, 255, 0.1);
  border: 1px solid rgba(180, 90, 255, 0.3);
  border-radius: 50px;
  color: #b45aff;
  font-size: 0.875rem;
  font-weight: 600;
  margin-bottom: 2rem;
  animation: fadeInDown 0.6s ease-out;
}

.badge-icon {
  width: 16px;
  height: 16px;
}

@keyframes fadeInDown {
  from {
    opacity: 0;
    transform: translateY(-20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.hero-title {
  font-size: clamp(2.5rem, 5vw, 4rem);
  font-weight: 800;
  color: #fafafa;
  line-height: 1.1;
  margin-bottom: 1.5rem;
  letter-spacing: -0.03em;
  animation: fadeInUp 0.6s ease-out 0.1s both;
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.gradient-text {
  background: linear-gradient(135deg, #b45aff 0%, #ff5aaf 50%, #00d9ff 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  display: inline-block;
  animation: gradientShift 3s ease infinite;
  background-size: 200% 200%;
}

@keyframes gradientShift {
  0%, 100% {
    background-position: 0% 50%;
  }
  50% {
    background-position: 100% 50%;
  }
}

.hero-description {
  font-size: 1.25rem;
  color: rgba(255, 255, 255, 0.7);
  line-height: 1.6;
  max-width: 600px;
  margin: 0 auto 3rem;
  animation: fadeInUp 0.6s ease-out 0.2s both;
}

.features-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
  gap: 1.5rem;
  max-width: 600px;
  margin: 0 auto;
  animation: fadeInUp 0.6s ease-out 0.3s both;
}

.feature-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.75rem;
  padding: 1.5rem 1rem;
  background: rgba(255, 255, 255, 0.03);
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 16px;
  transition: all 0.3s ease;
}

.feature-item:hover {
  background: rgba(255, 255, 255, 0.05);
  border-color: rgba(180, 90, 255, 0.5);
  transform: translateY(-5px);
  box-shadow: 0 10px 30px rgba(180, 90, 255, 0.2);
}

.feature-icon {
  font-size: 2rem;
  filter: drop-shadow(0 0 10px rgba(180, 90, 255, 0.5));
}

.feature-item span {
  font-size: 0.875rem;
  font-weight: 600;
  color: rgba(255, 255, 255, 0.9);
}

.animated-background {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  overflow: hidden;
  z-index: 1;
  pointer-events: none;
}

.gradient-orb {
  position: absolute;
  border-radius: 50%;
  filter: blur(80px);
  opacity: 0.4;
  animation: float 20s ease-in-out infinite;
}

.orb-1 {
  width: 400px;
  height: 400px;
  background: linear-gradient(135deg, #b45aff, #ff5aaf);
  top: -200px;
  left: -200px;
  animation-delay: 0s;
}

.orb-2 {
  width: 300px;
  height: 300px;
  background: linear-gradient(135deg, #00d9ff, #b45aff);
  top: 50%;
  right: -150px;
  animation-delay: -7s;
}

.orb-3 {
  width: 350px;
  height: 350px;
  background: linear-gradient(135deg, #ff5aaf, #00d9ff);
  bottom: -175px;
  left: 50%;
  animation-delay: -14s;
}

@keyframes float {
  0%, 100% {
    transform: translate(0, 0) scale(1);
  }
  33% {
    transform: translate(50px, -50px) scale(1.1);
  }
  66% {
    transform: translate(-50px, 50px) scale(0.9);
  }
}

@media (max-width: 768px) {
  .hero-section {
    padding: 3rem 1.5rem;
  }
  
  .hero-title {
    font-size: 2rem;
  }
  
  .hero-description {
    font-size: 1rem;
  }
  
  .features-grid {
    grid-template-columns: 1fr;
    gap: 1rem;
  }
}
</style>
