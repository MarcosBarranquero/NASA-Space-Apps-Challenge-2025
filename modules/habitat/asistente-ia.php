<?php
declare(strict_types=1);

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'OPTIONS') {
    exit(0);
}

$payload = json_decode(file_get_contents('php://input') ?: '', true);
$question = trim((string)($payload['pregunta'] ?? ''));

if ($question === '') {
    echo json_encode(['respuesta' => 'Please write a question about the habitat design.']);
    exit;
}

$q = mb_strtolower($question, 'UTF-8');

$modules = [
    'life support' => [
        'name' => 'Life Support Module',
        'score' => '3.8',
        'details' => [
            'Oxygen and carbon dioxide management.',
            'Air and water recycling.',
            'Humidity and pressure regulation.',
            'Redundant environmental monitoring systems.'
        ]
    ],
    'thermal' => [
        'name' => 'Thermal Control Module',
        'score' => '3.8',
        'details' => [
            'Heating and cooling for safe internal temperatures.',
            'Heat redistribution from machinery.',
            'Solar radiation shielding support.',
            'Sensors, insulation panels and heat exchangers.'
        ]
    ],
    'waste' => [
        'name' => 'Waste and Hygiene Module',
        'score' => '3.5',
        'details' => [
            'Sanitation and hygiene for the crew.',
            'Waste recycling and graywater recovery.',
            'Odor control and compact sealed storage.',
            'Corrosion-resistant and antibacterial materials.'
        ]
    ],
    'sleep' => [
        'name' => 'Crew Sleeping Quarters',
        'score' => '3.8',
        'details' => [
            'Private rest area and personal storage.',
            'Bed restraints for microgravity.',
            'Lighting and ventilation controls.',
            'Privacy and psychological comfort.'
        ]
    ],
    'recreation' => [
        'name' => 'Recreation and Observation Module',
        'score' => '2.2',
        'details' => [
            'Entertainment and relaxation area.',
            'Observation of Earth and Moon.',
            'Supports social interaction and morale.',
            'Large windows and digital telescope displays.'
        ]
    ],
    'exercise' => [
        'name' => 'Exercise Module',
        'score' => '3.4',
        'details' => [
            'Maintains physical fitness in microgravity.',
            'Includes treadmill, bike and resistance equipment.',
            'Helps stress relief and rehabilitation.',
            'Monitors crew vitals during training.'
        ]
    ],
    'medical' => [
        'name' => 'Medical Module',
        'score' => '4.2',
        'details' => [
            'Emergency care, diagnostics and first aid.',
            'Telemedicine support.',
            'Storage for medical supplies.',
            'Sterile finishes and medical-grade lighting.'
        ]
    ],
    'galley' => [
        'name' => 'Galley and Food Preparation Module',
        'score' => '3.5',
        'details' => [
            'Meal and drink preparation.',
            'Hydration and nutrient management.',
            'Food-safe surfaces and refrigerated storage.',
            'Waste collection for recycling.'
        ]
    ],
    'storage' => [
        'name' => 'Supply Storage Module',
        'score' => '3.5',
        'details' => [
            'Stores food, tools, water and mission supplies.',
            'Supports inventory control in microgravity.',
            'Uses cabinets, modular shelves and securing straps.',
            'Optimized for accessibility and cargo stability.'
        ]
    ],
    'plant' => [
        'name' => 'Plant Growth Module',
        'score' => '2.0',
        'details' => [
            'Supports oxygen production and food cultivation.',
            'Absorbs carbon dioxide.',
            'Uses hydroponics and LED grow lights.',
            'Adds psychological value for the crew.'
        ]
    ],
    'lab' => [
        'name' => 'Science Laboratory Module',
        'score' => '3.4',
        'details' => [
            'Scientific experiments and research operations.',
            'Sample storage and technology testing.',
            'Includes microscope, instruments and workstations.',
            'Uses anti-static and secure surfaces.'
        ]
    ],
    'communication' => [
        'name' => 'Communications and Mission Control Module',
        'score' => '4.6',
        'details' => [
            'Handles internal and external communications.',
            'Supports data analysis and system diagnostics.',
            'Includes control panels and ergonomic seats.',
            'Uses redundant communication channels.'
        ]
    ],
    'power' => [
        'name' => 'Power Module',
        'score' => '3.9',
        'details' => [
            'Generates, stores and distributes electrical energy.',
            'Provides backup routing for emergencies.',
            'Works with solar arrays and batteries.',
            'Includes insulated wiring and circuit breakers.'
        ]
    ],
    'core' => [
        'name' => 'Core Hub / Node Module',
        'score' => '4.8',
        'details' => [
            'Main structural connection point of the habitat.',
            'Central passageway between modules.',
            'Supports docking and module integration.',
            'Uses reinforced airtight junctions.'
        ]
    ],
    'dock' => [
        'name' => 'Docking and Logistics Module',
        'score' => '3.3',
        'details' => [
            'Docking for crew and cargo spacecraft.',
            'Cargo transfer and logistics support.',
            'Uses docking clamps, sensors and pressurized interfaces.',
            'Connects external operations with the habitat interior.'
        ]
    ],
    'airlock' => [
        'name' => 'Airlock Module',
        'score' => '4.5',
        'details' => [
            'Safe exit and entry for EVA operations.',
            'Supports decompression and suit storage.',
            'Uses airtight hatches and pressure monitoring.',
            'Critical for external maintenance and safety.'
        ]
    ],
    'passage' => [
        'name' => 'Connecting Passageways',
        'score' => '4.7',
        'details' => [
            'Crew transfer between modules.',
            'Supports cable routing and emergency egress.',
            'Includes horizontal, vertical and diagonal links.',
            'Uses handrails, anti-slip surfaces and emergency lighting.'
        ]
    ],
    'robotic arm' => [
        'name' => 'Robotic Arm / Space Crane',
        'score' => '3.4',
        'details' => [
            'Module installation and cargo handling.',
            'External repairs and maintenance support.',
            'Uses multi-axis articulation and precision motors.',
            'Can support deployment and positioning tasks.'
        ]
    ],
    'solar' => [
        'name' => 'Solar Panels',
        'score' => '4.2',
        'details' => [
            'Generate electrical power from sunlight.',
            'Provide redundancy for energy production.',
            'Use photovoltaic cells with sun tracking.',
            'Connect directly to the power system.'
        ]
    ],
];

function contains_any(string $haystack, array $needles): bool
{
    foreach ($needles as $needle) {
        if ($needle !== '' && mb_strpos($haystack, $needle) !== false) {
            return true;
        }
    }

    return false;
}

function module_response(array $module): string
{
    $lines = array_map(static fn(string $detail): string => '* ' . $detail, $module['details']);

    return "**{$module['name']}**\n"
        . implode("\n", $lines)
        . "\n\nOverall score: **{$module['score']} / 5**.";
}

if (contains_any($q, ['hi', 'hello', 'hey'])) {
    $answer = 'Hello! How can I help you design your space habitat?';
} elseif (contains_any($q, ['score', 'formula', 'rating', 'evaluate'])) {
    $answer = "**Scoring model**\n"
        . "* Functionality weight: 0.25\n"
        . "* Weight penalty: 0.05\n"
        . "* Cost penalty: 0.10\n"
        . "* Efficiency weight: 0.20\n"
        . "* Ergonomics weight: 0.15\n\n"
        . "Formula: **score = functionality*0.25 - weight*0.05 - cost*0.10 + efficiency*0.20 + ergonomics*0.15**.\n\n"
        . "The final habitat score is the sum of the individual module scores.";
} elseif (contains_any($q, ['crew', 'tripul', 'astronaut'])) {
    $answer = "**Crew baseline**\n"
        . "* The concept is designed for a crew of **6 people**.\n"
        . "* The habitat includes life support, accommodation, research, recreation and operations areas.\n"
        . "* Exercise, medical and observation spaces help maintain physical and mental well-being on long missions.";
} elseif (contains_any($q, ['safety', 'seguridad', 'emergency', 'eva'])) {
    $answer = "**Safety principles in the habitat**\n"
        . "* Airtight compartments and secure passageways.\n"
        . "* Fire and chemical hazard monitoring.\n"
        . "* Emergency protocols and evacuation routes.\n"
        . "* Airlock support for safe external operations.";
} else {
    $answer = null;
    foreach ($modules as $keyword => $module) {
        if (mb_strpos($q, $keyword) !== false) {
            $answer = module_response($module);
            break;
        }
    }

    if ($answer === null) {
        $answer = "I'm sorry, I don't have information about that in my manuals. "
            . "Would you like me to explain a habitat module, the scoring system, or the crew and safety design?";
    }
}

echo json_encode(['respuesta' => $answer], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
