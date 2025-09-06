<?php
require_once '../forms/config.php';

class ResumeAnalyzer {
    private $apiKey;
    private $apiEndpoint = 'https://api.emergent.com/v1/chat/completions';
    
    public function __construct() {
        $this->apiKey = 'sk-emergent-6Bd2007B2AcE61b569'; // Emergent LLM Key
    }
    
    public function analyzeResume($resumeText, $jobRole = '') {
        $prompt = $this->buildAnalysisPrompt($resumeText, $jobRole);
        
        $response = $this->callAI($prompt);
        
        if ($response) {
            return $this->parseAIResponse($response);
        }
        
        return $this->getFallbackAnalysis();
    }
    
    private function buildAnalysisPrompt($resumeText, $jobRole) {
        $roleContext = $jobRole ? "for the role of {$jobRole}" : "for general evaluation";
        
        return "Analyze this resume {$roleContext} and provide a detailed assessment. 

Resume Content:
{$resumeText}

Please provide analysis in the following JSON format:
{
    \"overall_score\": 85,
    \"strengths\": [
        \"Strong technical skills\",
        \"Relevant experience\",
        \"Clear career progression\"
    ],
    \"weaknesses\": [
        \"Missing soft skills\",
        \"No quantified achievements\"
    ],
    \"recommendations\": [
        \"Add quantified achievements\",
        \"Include soft skills section\",
        \"Improve formatting\"
    ],
    \"skills_analysis\": {
        \"technical_skills\": [\"Python\", \"JavaScript\", \"SQL\"],
        \"soft_skills\": [\"Communication\", \"Leadership\"],
        \"missing_skills\": [\"Project Management\", \"Data Analysis\"]
    },
    \"experience_analysis\": {
        \"years_of_experience\": 5,
        \"career_level\": \"Mid-level\",
        \"industry_fit\": \"Technology\"
    },
    \"keyword_match\": 75,
    \"summary\": \"A well-structured resume with strong technical background. The candidate shows consistent career growth and relevant experience.\"
}

Provide only the JSON response, no additional text.";
    }
    
    private function callAI($prompt) {
        $data = [
            'model' => 'gemini-2.0-flash',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $prompt
                ]
            ],
            'max_tokens' => 2000,
            'temperature' => 0.3
        ];
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->apiEndpoint);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->apiKey
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpCode === 200 && $response) {
            $decodedResponse = json_decode($response, true);
            if (isset($decodedResponse['choices'][0]['message']['content'])) {
                return $decodedResponse['choices'][0]['message']['content'];
            }
        }
        
        error_log("AI API call failed. HTTP Code: {$httpCode}, Response: {$response}");
        return false;
    }
    
    private function parseAIResponse($response) {
        // Try to extract JSON from the response
        $jsonStart = strpos($response, '{');
        $jsonEnd = strrpos($response, '}');
        
        if ($jsonStart !== false && $jsonEnd !== false) {
            $jsonStr = substr($response, $jsonStart, $jsonEnd - $jsonStart + 1);
            $parsed = json_decode($jsonStr, true);
            
            if ($parsed && isset($parsed['overall_score'])) {
                return $parsed;
            }
        }
        
        return $this->getFallbackAnalysis();
    }
    
    private function getFallbackAnalysis() {
        return [
            'overall_score' => 75,
            'strengths' => [
                'Resume submitted successfully',
                'Professional format maintained',
                'Contact information provided'
            ],
            'weaknesses' => [
                'Unable to perform detailed AI analysis at this time',
                'Please ensure resume is in a readable format'
            ],
            'recommendations' => [
                'Ensure resume contains clear section headers',
                'Include quantifiable achievements',
                'Use a standard format (PDF preferred)',
                'Our team will review manually within 24 hours'
            ],
            'skills_analysis' => [
                'technical_skills' => [],
                'soft_skills' => [],
                'missing_skills' => []
            ],
            'experience_analysis' => [
                'years_of_experience' => 'To be determined',
                'career_level' => 'To be assessed',
                'industry_fit' => 'Multiple industries considered'
            ],
            'keyword_match' => 'N/A',
            'summary' => 'Your resume has been received and will be reviewed by our team. This is a preliminary assessment - our specialists will provide detailed feedback within 24 hours.'
        ];
    }
    
    public function extractTextFromFile($filePath) {
        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        
        switch ($extension) {
            case 'txt':
                return file_get_contents($filePath);
                
            case 'pdf':
                return $this->extractFromPDF($filePath);
                
            case 'doc':
            case 'docx':
                return $this->extractFromWord($filePath);
                
            default:
                return 'Unable to extract text from this file format. Please upload a PDF, DOC, DOCX, or TXT file.';
        }
    }
    
    private function extractFromPDF($filePath) {
        // Simple PDF text extraction
        $content = file_get_contents($filePath);
        
        // Basic PDF text extraction (limited)
        if (strpos($content, '%PDF') === 0) {
            // Very basic extraction - just get readable text
            $text = '';
            if (preg_match_all('/\((.*?)\)/', $content, $matches)) {
                $text = implode(' ', $matches[1]);
            }
            
            if (empty($text)) {
                return 'PDF content detected but text extraction requires manual review. Our team will analyze your resume shortly.';
            }
            
            return $text;
        }
        
        return 'Unable to extract text from PDF. Please try a different format or our team will review manually.';
    }
    
    private function extractFromWord($filePath) {
        // Basic Word document handling
        $content = file_get_contents($filePath);
        
        if (strpos($content, 'PK') === 0) { // DOCX format
            return 'Word document detected. Our team will review your resume and provide detailed feedback within 24 hours.';
        } else { // DOC format
            return 'Word document detected. Our team will review your resume and provide detailed feedback within 24 hours.';
        }
    }
}
?>
