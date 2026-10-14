<?php
// Define the coordinator job details
$coordinator_job = [
    'title' => 'Operations and Executive Support Coordinators (Two Positions)',
    'department' => 'Operations & Executive Support',
    'location' => 'Richmond Heights, OH (Hybrid / Remote Available)',
    'type' => 'Full-Time (Two Positions)',
    'apply_url' => '/apply-operations',
    'roles' => [
        'Operations Coordinator' => 'Operations Coordinator (Peatech Operations & Team Reporting)',
        'Executive Support Coordinator' => 'Executive Support Coordinator (Peatech Executive Support)',
        'Open to Either Role' => 'Open to Either Role (Both Positions)'
    ],
    'description' => 'Peatech is hiring two coordinators to support Peatech’s operations and executive day-to-day priorities. Each coordinator will own assigned areas and provide backup for the other.',
    'responsibilities' => [
        'Property operations' => [
            'Monitor reservations across all listing platforms and keep calendars synchronized to prevent double bookings.',
            'Respond to guest inquiries and concerns promptly, escalating issues that need management attention.',
            'Keep approved property listings accurate and complete, including photos, descriptions, amenities, and availability.',
            'Track cleaning, maintenance, guest requests, and other property tasks through completion.'
        ],
        'Remote team reporting and performance' => [
            'Review each associate’s weekly report in the company drive and follow up on missing or incomplete reports.',
            'Compare reported work with assigned tickets, submitted files, agreed milestones, and other available evidence.',
            'Maintain a performance tracker covering deliverables completed, deadlines met, work awaiting review, unresolved blockers, and follow-up actions.',
            'Request confirmation from the appropriate project lead before marking technical work as accepted.',
            'Prepare a payment review summary showing agreed compensation, approved milestone or performance payments, and any items requiring management review. Management makes the final payment decision.'
        ],
        'Peatech operations and executive support' => [
            'Maintain a company-wide action tracker with owners, deadlines, and status updates; follow up until open items are resolved.',
            'Turn meeting decisions into tickets and confirm they are assigned to the right people.',
            'Organize expenses, receipts, invoices, and supporting records so they are ready for accounting and tax preparation.',
            'Maintain an inventory of company assets and help gather records for valuation and patent applications.',
            'Manage executive meeting calendars and send timely reminders.'
        ],
        'Marketing and communications' => [
            'Coordinate corporate documentation and follow-ups with professional advisers, while keeping organizational documents complete and organized.',
            'Help promote company initiatives, announcements, and social media channels.',
            'Support the marketing team with campaign coordination, content schedules, and follow-up tasks.'
        ],
        'Additional responsibilities' => [
            'Create simple checklists and procedures for recurring work, including weekly reporting, guest responses, expense submission, and meeting follow-up.',
            'Track contract renewals, subscriptions, filing deadlines, and other important dates.',
            'Help onboard new associates by confirming they have their assignments, reporting templates, and appropriate access.',
            'Produce a concise weekly management dashboard showing property issues, project progress, overdue tasks, missing records, and decisions needed from leadership.'
        ]
    ],
    'requirements' => [
        'Handle company, worker, financial, and guest information confidentially and flag urgent issues promptly.',
        'Strong organizational, multi-tasking, and follow-up skills with rigorous attention to detail.',
        'Experience with online booking/calendar management, document control (Google Drive/Sheets), and operational trackers.',
        'Ability to review weekly associate reports, cross-reference tickets and deliverables, and prepare executive summaries.',
        'High level of accountability, professional communication, and ability to handle sensitive executive matters.'
    ],
    'benefits' => [
        'Competitive compensation with performance milestones and regular review.',
        'Comprehensive exposure across expanding operations at Peatech.',
        'Flexible working arrangement with direct mentorship from leadership.',
        'Structured procedures and templates with opportunities for career growth.'
    ]
];

// Define all available jobs and aliases
$jobs = [
    // Primary new job with various slug aliases
    'operations-and-executive-support-coordinators' => $coordinator_job,
    'operations-executive-support-coordinators'     => $coordinator_job,
    'operations-coordinator'                         => $coordinator_job,
    'executive-support-coordinator'                 => $coordinator_job,
    'coordinators'                                   => $coordinator_job,
    'coordinator'                                    => $coordinator_job,

    'smart-system-engineer' => [
        'title' => 'Smart System Engineer',
        'department' => 'Engineering & Systems Integration',
        'location' => '',
        'type' => 'Full-Time',
        'apply_url' => '/apply-smart-system-engineer',
        'roles' => ['Smart System Engineer' => 'Smart System Engineer'],
        'description' => 'Design, integrate, and support intelligent systems that connect sensors, devices, software, and automation. Work with multidisciplinary teams to turn engineering requirements into reliable solutions for monitoring, control, and data-driven decisions.',
        'responsibilities' => [
            'Systems design and integration' => [
                'Translate requirements into system architectures, interface specifications, and implementation plans.',
                'Integrate sensors, controllers, embedded devices, and IoT platforms with software and data services.',
                'Develop and maintain telemetry pipelines connecting physical equipment to monitoring and digital twin systems.'
            ],
            'Automation, testing, and reliability' => [
                'Build and troubleshoot automation, monitoring, and control workflows.',
                'Plan and execute integration tests, validate sensor data, and investigate system faults.',
                'Document configurations, test results, deployment procedures, and maintenance guidance.',
                'Collaborate with engineering teams to improve system performance, security, and reliability.'
            ]
        ],
        'requirements' => [
            'Degree in Electrical, Electronic, Computer, Mechanical, Mechatronics Engineering, or a related discipline, or equivalent practical experience.',
            'Practical experience integrating sensors, embedded systems, IoT devices, or industrial automation equipment.',
            'Programming or scripting skills in Python, C/C++, or a comparable language.',
            'Understanding of networking, device communication protocols, and data acquisition.',
            'Ability to troubleshoot hardware and software interfaces and communicate findings clearly.',
            'Experience with digital twins, control systems, or cloud-connected monitoring is an advantage.'
        ]
    ],

    // Existing jobs retained
    'sales-marketing-specialist' => [
        'title' => 'Sales/Marketing Specialist',
        'department' => 'Sales & Marketing',
        'location' => 'Richmond Heights, OH (On-Site)',
        'type' => 'Full-Time',
        'roles' => [
            'Sales/Marketing Specialist' => 'Sales/Marketing Specialist'
        ],
        'description' => 'We are seeking a dynamic Sales/Marketing Specialist to lead our B2B outreach campaigns, promote Peatech\'s connectivity services, manage customer relationships, and expand strategic market share.',
        'responsibilities' => [
            'Develop and implement B2B sales strategies to acquire enterprise clients.',
            'Coordinate branding and digital marketing campaigns for Peatech Services and our PeaSyn simulation suite.',
            'Manage customer relations, lead generation, and outbound sales pipelines.',
            'Collaborate with R&D teams to translate technical capabilities into clear client pitches.'
        ],
        'requirements' => [
            'Bachelor\'s degree in Marketing, Business Administration, or a related field.',
            'Experience in technical B2B sales or software marketing.',
            'Proven track record of managing digital campaigns and closing partnership deals.',
            'Exceptional communication, presentation, and negotiation skills.'
        ],
        'benefits' => [
            'Competitive base salary with performance-based commission incentives.',
            'Comprehensive healthcare, dental, and vision insurance packages.',
            'Flexible working schedule.',
            'Rapid career development in an innovative engineering service firm.'
        ]
    ],
    'engineering-intern' => [
        'title' => 'Engineering Intern',
        'department' => 'Research & Development',
        'location' => 'Richmond Heights, OH (On-Site)',
        'type' => 'Internship / Part-Time',
        'apply_url' => '/apply-engineering-intern',
        'roles' => [
            'Engineering Intern' => 'Engineering Intern'
        ],
        'description' => 'We are looking for a motivated Engineering Intern to support our advanced additive manufacturing modeling teams. You will work directly with our physics solvers and telemetry sync processes on the PeaSyn digital twin suite.',
        'responsibilities' => [
            'Assist in developing and refining physics-based models for wire-arc additive manufacturing (WAAM).',
            'Conduct computational simulations analyzing peak transient thermal gradients and melt pool dynamics.',
            'Support database integration, sync processes, and data translation workflows.',
            'Analyze experimental print datasets to validate simulation accuracy.'
        ],
        'requirements' => [
            'Currently pursuing a BS, MS, or PhD in Mechanical Engineering, Materials Science, Aerospace Engineering, or Computer Science.',
            'Strong foundation in heat transfer, numerical methods (FEM/CFD), or physical metallurgy.',
            'Basic scripting skills in Python, MATLAB, or C++.',
            'Eagerness to learn, iterate, and collaborate in a high-speed R&D environment.'
        ],
        'benefits' => [
            'Paid internship with flexible hours designed around your academic schedule.',
            'Direct mentorship from advanced manufacturing researchers and senior software engineers.',
            'Hands-on experience with industrial digital twin software platforms.',
            'Potential transition to full-time staff engineering positions upon graduation.'
        ]
    ]
];

// Application metadata and role-specific screening fields.
$jobs['operations-and-executive-support-coordinators']['job_id'] = 'PTECH-2026-OPS02';
$jobs['operations-and-executive-support-coordinators']['category'] = 'Operations Management & Executive Support';
$jobs['operations-and-executive-support-coordinators']['function'] = 'Operations & Leadership Support';
$jobs['smart-system-engineer']['job_id'] = 'PTECH-2026-SSE01';
$jobs['engineering-intern']['job_id'] = 'PTECH-2026-INT01';
$jobs['smart-system-engineer']['screening_fields'] = [
    'technical_skills' => 'Technical skills: programming, sensors, controllers, IoT, and communication protocols',
    'integration_experience' => 'Describe a system integration or automation project and your contribution',
    'availability' => 'Available start date and working availability'
];
$jobs['engineering-intern']['screening_fields'] = [
    'study_program' => 'Current degree/program and institution',
    'graduation' => 'Expected graduation month and year',
    'technical_skills' => 'Relevant skills: Python, MATLAB, C++, simulation, or engineering analysis',
    'engineering_project' => 'Describe a relevant academic, research, or personal engineering project',
    'availability' => 'Available start date, internship duration, and hours per week'
];
