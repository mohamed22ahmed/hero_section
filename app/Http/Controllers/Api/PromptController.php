<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PromptController extends Controller
{
    protected $promptService;

    public function __construct(\App\Services\PromptImprovementService $promptService)
    {
        $this->promptService = $promptService;
    }

    /**
     * Improve a user's rough website idea into a comprehensive prompt.
     */
    public function improve(\App\Http\Requests\ImprovePromptRequest $request)
    {
        try {
            // Get the improved prompt from the service
            $result = $this->promptService->improvePrompt($request->input('original_prompt'));
            
            // Store in database
            $prompt = \App\Models\Prompt::create($result);
            
            // Return the response
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $prompt->id,
                    'original_prompt' => $prompt->original_prompt,
                    'improved_prompt' => $prompt->improved_prompt,
                    'metadata' => $prompt->metadata,
                ],
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to improve prompt. Please try again.',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }
}
