<?php

namespace App\Services;

class PromptImprovementService
{
    /**
     * Improve a rough website idea into a comprehensive, structured prompt.
     */
    public function improvePrompt(string $originalPrompt): array
    {
        $originalPrompt = trim($originalPrompt);
        
        // Analyze the input to extract key concepts
        $analysis = $this->analyzePrompt($originalPrompt);
        
        // Build the improved prompt
        $improvedPrompt = $this->buildImprovedPrompt($originalPrompt, $analysis);
        
        // Generate metadata
        $metadata = [
            'original_word_count' => str_word_count($originalPrompt),
            'improved_word_count' => str_word_count($improvedPrompt),
            'enhancement_type' => $analysis['type'],
            'suggested_frameworks' => $analysis['frameworks'],
            'processed_at' => now()->toIso8601String(),
        ];
        
        return [
            'original_prompt' => $originalPrompt,
            'improved_prompt' => $improvedPrompt,
            'metadata' => $metadata,
        ];
    }
    
    /**
     * Analyze the prompt to extract key information.
     */
    private function analyzePrompt(string $prompt): array
    {
        $lowerPrompt = strtolower($prompt);
        
        // Detect type of website/app
        $type = 'general website';
        $frameworks = ['Vue.js', 'Laravel'];
        $features = [];
        
        // E-commerce detection
        if (preg_match('/\b(shop|store|ecommerce|e-commerce|product|cart|checkout|payment)\b/i', $prompt)) {
            $type = 'e-commerce platform';
            $features = ['Product catalog', 'Shopping cart', 'Secure checkout', 'Payment integration', 'Order management'];
            $frameworks[] = 'Stripe/PayPal';
        }
        // Blog/Content detection
        elseif (preg_match('/\b(blog|article|content|post|cms|news)\b/i', $prompt)) {
            $type = 'content management system';
            $features = ['Rich text editor', 'Category management', 'Tag system', 'Comment functionality', 'SEO optimization'];
        }
        // Portfolio detection
        elseif (preg_match('/\b(portfolio|showcase|work|project)\b/i', $prompt)) {
            $type = 'portfolio website';
            $features = ['Project gallery', 'Image optimization', 'Filtering system', 'Contact form', 'Responsive design'];
        }
        // Social/Community detection
        elseif (preg_match('/\b(social|community|forum|chat|message|network)\b/i', $prompt)) {
            $type = 'social platform';
            $features = ['User authentication', 'Real-time messaging', 'User profiles', 'Activity feed', 'Notifications'];
            $frameworks[] = 'Laravel WebSockets';
        }
        // Recipe/Food detection
        elseif (preg_match('/\b(recipe|food|cooking|meal|ingredient)\b/i', $prompt)) {
            $type = 'recipe application';
            $features = ['Recipe database', 'Search and filter', 'Ingredient lists', 'Step-by-step instructions', 'User ratings'];
        }
        // Dashboard/Analytics detection
        elseif (preg_match('/\b(dashboard|analytics|chart|graph|report|metric|data)\b/i', $prompt)) {
            $type = 'analytics dashboard';
            $features = ['Data visualization', 'Real-time updates', 'Export functionality', 'Custom reports', 'Interactive charts'];
            $frameworks[] = 'Chart.js';
        }
        // Booking/Reservation detection
        elseif (preg_match('/\b(book|booking|reservation|appointment|schedule)\b/i', $prompt)) {
            $type = 'booking system';
            $features = ['Calendar integration', 'Availability management', 'Email notifications', 'Payment processing', 'Booking confirmation'];
        }
        // Landing page detection
        elseif (preg_match('/\b(landing|hero|promote|marketing|campaign)\b/i', $prompt)) {
            $type = 'landing page';
            $features = ['Hero section', 'Call-to-action buttons', 'Lead capture form', 'Social proof', 'Mobile responsive'];
        }
        
        // Add default features if none detected
        if (empty($features)) {
            $features = ['Responsive design', 'User authentication', 'Database integration', 'RESTful API', 'Modern UI'];
        }
        
        return [
            'type' => $type,
            'frameworks' => $frameworks,
            'features' => $features,
        ];
    }
    
    /**
     * Build the improved prompt from the analysis.
     */
    private function buildImprovedPrompt(string $original, array $analysis): string
    {
        $improved = "# Project Brief: " . ucfirst($analysis['type']) . "\n\n";
        
        $improved .= "## Original Idea\n";
        $improved .= $original . "\n\n";
        
        $improved .= "## Enhanced Project Description\n";
        $improved .= "Build a modern, full-featured " . $analysis['type'] . " that provides an exceptional user experience. ";
        $improved .= "The application should be scalable, maintainable, and follow industry best practices.\n\n";
        
        $improved .= "## Key Features\n";
        foreach ($analysis['features'] as $index => $feature) {
            $improved .= ($index + 1) . ". **{$feature}**: Implement a robust and user-friendly {$feature} system\n";
        }
        $improved .= "\n";
        
        $improved .= "## Technical Requirements\n\n";
        
        $improved .= "### Frontend\n";
        $improved .= "- **Framework**: Vue.js 3 with Composition API\n";
        $improved .= "- **Styling**: Modern CSS with Tailwind CSS or custom design system\n";
        $improved .= "- **State Management**: Pinia or Vuex for complex state\n";
        $improved .= "- **Routing**: Vue Router for SPA navigation\n";
        $improved .= "- **UI Components**: Reusable, accessible components\n\n";
        
        $improved .= "### Backend\n";
        $improved .= "- **Framework**: Laravel 10+ with RESTful API architecture\n";
        $improved .= "- **Database**: MySQL/PostgreSQL with proper indexing\n";
        $improved .= "- **Authentication**: Laravel Sanctum or Passport\n";
        $improved .= "- **Validation**: Form Request validation for all inputs\n";
        $improved .= "- **Testing**: PHPUnit tests for critical functionality\n\n";
        
        if (!empty($analysis['frameworks'])) {
            $improved .= "### Additional Technologies\n";
            foreach ($analysis['frameworks'] as $framework) {
                $improved .= "- {$framework}\n";
            }
            $improved .= "\n";
        }
        
        $improved .= "## Design Guidelines\n";
        $improved .= "- **Aesthetic**: Modern, clean, and professional design\n";
        $improved .= "- **Color Scheme**: Choose a harmonious palette that reflects the brand\n";
        $improved .= "- **Typography**: Use readable fonts like Inter, Roboto, or similar\n";
        $improved .= "- **Animations**: Smooth, purposeful micro-interactions\n";
        $improved .= "- **Responsive**: Mobile-first approach, perfect on all devices\n";
        $improved .= "- **Accessibility**: WCAG 2.1 AA compliance\n\n";
        
        $improved .= "## User Experience\n";
        $improved .= "- Intuitive navigation with clear information architecture\n";
        $improved .= "- Fast loading times (aim for <2s initial load)\n";
        $improved .= "- Clear feedback for all user actions\n";
        $improved .= "- Error handling with helpful, user-friendly messages\n";
        $improved .= "- Seamless flow from landing to conversion\n\n";
        
        $improved .= "## Development Priorities\n";
        $improved .= "1. Core functionality and user flows\n";
        $improved .= "2. Responsive design implementation\n";
        $improved .= "3. Performance optimization\n";
        $improved .= "4. Security best practices\n";
        $improved .= "5. Testing and quality assurance\n\n";
        
        $improved .= "## Success Metrics\n";
        $improved .= "- User engagement and retention rates\n";
        $improved .= "- Page load performance scores\n";
        $improved .= "- Conversion rate (if applicable)\n";
        $improved .= "- Code quality and maintainability\n";
        $improved .= "- User satisfaction feedback";
        
        return $improved;
    }
}
