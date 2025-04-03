class OrliaAssistant {
    constructor() {
        this.initializeUI();
        this.bindEvents();
        this.eventData = {
            // Day 1 Events
            'tamil speech': {
                day: 1,
                time: '9:30 AM - 11:00 AM',
                venue: 'CH-2',
                type: 'Solo',
                rules: ['Two rounds competition', 'First round: 3 minutes speech', 'Second round: 5 minutes preparation, 3 minutes speech']
            },
            'english speech': {
                day: 1,
                time: '9:30 AM - 11:00 AM',
                venue: 'CH-2',
                type: 'Solo',
                rules: ['Duration: 3-4 minutes', 'Round 1: Speech on given topic', 'Round 2: On-the-spot topic']
            },
            'singing': {
                day: 1,
                time: '9:30 AM - 11:00 AM',
                venue: 'CH-3',
                type: 'Solo',
                rules: ['Sing with or without instruments', 'Karaoke allowed; submit in advance if needed', 'Judged on vocal quality, stage presence, expression']
            },
            'solo dance': {
                day: 1,
                time: '9:30 AM - 11:00 AM',
                venue: 'Open Air Theatre',
                type: 'Solo',
                rules: ['Solo competition (individual participants only)', 'Random songs played based on slot selection', 'Judged on spontaneity, expression, and adaptability']
            },
            'drawing': {
                day: 1,
                time: '10:30 AM - 11:30 AM',
                venue: 'Drawing Hall',
                type: 'Solo',
                rules: ['Theme-based drawing', '60 minutes duration', 'A3 or A4 sheets, any medium allowed']
            },
            'trailer time': {
                day: 1,
                time: '10:30 AM - 12:00 PM',
                venue: 'CH-1',
                type: 'Group (1-2 members)',
                rules: ['1-3 minutes duration', 'Audio & video provided on spot', 'Original creation only, no plagiarism']
            },
            'fireless cooking': {
                day: 1,
                time: '11:00 AM - 12:30 PM',
                venue: 'Vishweshwaraya Hall',
                type: 'Group (2 members)',
                rules: ['Bring own materials', 'No heat-based appliances', 'Time limit: 90 minutes']
            },
            'dump charades': {
                day: 1,
                time: '12:30 PM - 2:00 PM',
                venue: 'CH-1',
                type: 'Group (2-3 members)',
                rules: ['Three rounds of competition', 'Based on concentration and team coordination', 'Maximum 3 members per team']
            },
            'ipl auction': {
                day: 1,
                time: '1:00 PM - 3:00 PM',
                venue: 'CH-5',
                type: 'Group (3 members)',
                rules: ['Virtual money provided for bidding', 'Team structure requirements must be met', 'Specific player categories to be selected']
            },
            'mehandi': {
                day: 1,
                time: '1:30 PM - 3:00 PM',
                venue: 'Vivekanandha Hall',
                type: 'Solo',
                rules: ['Individual event', 'Bring own materials', 'Time duration: 60 Minutes']
            },
            'lyrical hunt': {
                day: 1,
                time: '1:30 PM - 3:30 PM',
                venue: 'CH-4',
                type: 'Group (2-3 members)',
                rules: ['Identify songs and complete lyrics', 'Time-limited rounds', 'Team coordination required']
            },
            'divide and conquer': {
                day: 1,
                time: '2:00 PM - 3:30 PM',
                venue: 'CH-2',
                type: 'Group (4-5 members)',
                rules: ['Group-based activities', 'Strategic task division', 'Team coordination essential']
            },
            'meme creation': {
                day: 1,
                time: '2:00 PM - 3:30 PM',
                venue: 'CH-3',
                type: 'Solo',
                rules: ['Submit memes/reels on given themes', 'No offensive content', 'Reel duration: 20-45 seconds']
            },
            'group dance': {
                day: 1,
                time: '4:00 PM',
                venue: 'Ground',
                type: 'Group (6-15 members)',
                rules: ['5 minutes duration', 'Track verification required by 29.03.2025', 'Any dance form allowed']
            },

            // Day 2 Events
            'rangoli': {
                day: 2,
                time: '9:00 AM - 10:30 AM',
                venue: 'Ground',
                type: 'Group (3-4 members)',
                rules: ['60 minutes duration', 'Bring own materials', 'Theme: Orlia2k25 Cultural Fest']
            },
            'photography': {
                day: 2,
                time: '9:00 AM - 3:30 PM',
                venue: 'APJ&RK Block Entrance',
                type: 'Solo',
                rules: ['One image per participant', 'Submit before 31.03.2025', 'Theme: Favorite place in MKCE']
            },
            'instrumental': {
                day: 2,
                time: '9:00 AM - 10:00 AM',
                venue: 'Open Air Theatre',
                type: 'Solo',
                rules: ['3-5 minutes performance', 'Bring own instruments', 'Singing allowed with playing']
            },
            'treasure hunt': {
                day: 2,
                time: '10:00 AM - 12:00 PM',
                venue: 'Vivekanandha Hall',
                type: 'Group (3-4 members)',
                rules: ['Solve clues in order', 'No skipping/tampering', 'Time-bound challenge']
            },
            'short film': {
                day: 2,
                time: '11:00 AM - 12:30 PM',
                venue: 'CH-3',
                type: 'Solo',
                rules: ['Original content only', 'Maximum 12 minutes duration', 'No offensive content']
            },
            'mime': {
                day: 2,
                time: '11:00 AM - 12:30 PM',
                venue: 'CH-5',
                type: 'Solo',
                rules: ['7-12 minutes duration', 'Background music allowed', 'Avoid sensitive topics']
            },
            'best manager': {
                day: 2,
                time: '11:00 AM - 12:30 PM',
                venue: 'CH-4',
                type: 'Solo',
                rules: ['Round 1: Quiz', 'Round 2: Group Discussion', 'Round 3: Scenario based talk']
            },
            'art from waste': {
                day: 2,
                time: '12:00 PM - 1:30 PM',
                venue: 'Vishweshwaraya Hall',
                type: 'Group (2 members)',
                rules: ['60 minutes duration', 'Use only recyclable materials', 'Bring own materials']
            },
            'sherlock holmes': {
                day: 2,
                time: '1:00 PM - 3:30 PM',
                venue: 'CH-3',
                type: 'Group (2-3 members)',
                rules: ['Multiple investigation rounds', 'Solve encrypted messages', 'Detective-themed puzzles']
            },
            'free fire': {
                day: 2,
                time: '2:00 PM - 4:00 PM',
                venue: 'Vivekanandha Hall',
                type: 'Group (4 members)',
                rules: ['Mobile players only', 'Gun skin off', 'Character skill allowed']
            },
            'rj vj hunt': {
                day: 2,
                time: '2:00 PM - 3:30 PM',
                venue: 'CH-4',
                type: 'Solo',
                rules: ['On-the-spot topic', '3-5 minutes presentation', 'Judged on originality and engagement']
            },
            'vegetable fruit art': {
                day: 2,
                time: '2:00 PM - 3:30 PM',
                venue: 'Vishweshwaraya Hall',
                type: 'Group (1-2 members)',
                rules: ['60 minutes duration', 'Use only vegetables & fruits', 'Bring own materials']
            },
            'twin dance': {
                day: 2,
                time: '4:00 PM - 5:30 PM',
                venue: 'Ground',
                type: 'Group (2 members)',
                rules: ['4 minutes duration', 'Track verification by 29.03.2025', 'Proper dress code required']
            }
        };

        this.responses = {
            'default': 'Welcome to Orlia\'25! I can help you with:\n• Event details and schedules\n• Registration process\n• Rules and guidelines\n• Venue information\n• Contact details\n\nWhat would you like to know about?',
            
            'events': {
                'general': 'Orlia\'25 features 27 exciting events across two days:\n\nDay 1: Speech competitions, Singing, Dancing, Drawing, and more creative events.\nDay 2: Artistic events like Rangoli, Photography, and performance events.\n\nWould you like to know about specific events?',
                'cultural': 'We have various cultural events including:\n• Tamil & English Speech\n• Solo & Group Dance\n• Singing & Instrumental\n• Mime/Skit performances\n\nWhich one interests you?',
                'artistic': 'Our artistic events include:\n• Rangoli\n• Drawing\n• Photography\n• Art from Waste\n• Vegetable & Fruit Art\n\nWould you like details about any of these?',
                'technical': 'Technical and creative events include:\n• Short Film Making\n• Trailer Time\n• Meme Creation\n• RJ/VJ Hunt\n\nWhich event would you like to know more about?'
            },
            
            'registration': {
                'solo': 'For solo events:\n1. Click "Register Now" on the event card\n2. Fill in your details\n3. Submit your registration\n4. Check your email for confirmation\n\nNote: Register early as some events have limited slots!',
                'group': 'For group events:\n1. Team leader registers first\n2. Click "Register Now" on the event card\n3. Add team members\' details\n4. Ensure team size matches event requirements\n5. Submit registration\n\nImportant: Check the maximum team size for your chosen event!',
                'deadline': 'Registration deadlines:\n• Regular registration: March 25, 2025\n• Late registration: March 30, 2025\n• On-spot registration available for select events'
            },
            
            'schedule': {
                'overview': 'Orlia\'25 is scheduled for April 3-4, 2025:\n\nDay 1: 9:30 AM - 4:00 PM\nDay 2: 9:00 AM - 5:30 PM\n\nWould you like to see the schedule for a specific day?',
                'morning': 'Morning events typically start from:\nDay 1: 9:30 AM (Speech, Singing, Dance)\nDay 2: 9:00 AM (Rangoli, Photography)',
                'afternoon': 'Afternoon events include:\nDay 1: IPL Auction, Mehandi, Group Dance\nDay 2: Art competitions, Gaming, Twin Dance'
            },
            
            'rules': {
                'general': 'General guidelines:\n• Arrive 30 minutes before your event\n• Carry valid college ID\n• Follow event-specific rules\n• Judges\' decision is final\n\nWhich event\'s rules would you like to know?',
                'participation': 'Participation rules:\n• Open to our college students\n• One person can participate in multiple events\n• Prior registration mandatory'
            },
            
            'venue': {
                'directions': 'Main venues at MKCE campus:\n• Open Air Theatre: Main ground\n• CH Blocks: Near college entrance\n• Vishweshwaraya Hall: Main building\n\nNeed directions to a specific venue?',
                'facilities': 'Available facilities:\n• Green rooms for performers\n• Technical support at venues\n• Refreshment areas\n• First aid stations'
            },
            
            'contact': {
                'general': 'Contact Information:\n• Email: fineartsclub2k25@gmail.com\n• Phone: +91 7373888818',
                'support': 'For technical support:\n• Website issues: tech@orlia25.com\n• Registration help: support@orlia25.com',
                'emergency': 'Emergency contacts:\n• Event Coordinator: +91 8754731542\n• Campus Security: +91 9952755386'
            }
        };

        this.quickResponses = {
            'day1': `Here are all Day 1 events:\n
• Tamil Speech (9:30 AM - 11:00 AM, CH-2)
• English Speech (9:30 AM - 11:00 AM, CH-2)
• Singing (9:30 AM - 11:00 AM, CH-3)
• Solo Dance (9:30 AM - 11:00 AM, Open Air Theatre)
• Drawing (10:30 AM - 11:30 AM, Drawing Hall)
• Trailer Time (10:30 AM - 12:00 PM, CH-1)
• Fireless Cooking (11:00 AM - 12:30 PM, Vishweshwaraya Hall)
• Dump Charades (12:30 PM - 2:00 PM, CH-1)
• IPL Auction (1:00 PM - 3:00 PM, CH-5)
• Mehandi (1:30 PM - 3:00 PM, Vivekanandha Hall)
• Lyrical Hunt (1:30 PM - 3:30 PM, CH-4)
• Divide and Conquer (2:00 PM - 3:30 PM, CH-2)
• Meme Creation (2:00 PM - 3:30 PM, CH-3)
• Group Dance (4:00 PM, Ground)\n
Which event would you like to know more about?`,

            'day2': `Here are all Day 2 events:\n
• Rangoli (9:00 AM - 10:30 AM, Ground)
• Photography (9:00 AM - 3:30 PM, APJ&RK Block)
• Instrumental Playing (9:00 AM - 10:00 AM, Open Air Theatre)
• Treasure Hunt (10:00 AM - 12:00 PM, Vivekanandha Hall)
• Short Film (11:00 AM - 12:30 PM, CH-3)
• Mime/Skit (11:00 AM - 12:30 PM, CH-5)
• Best Manager (11:00 AM - 12:30 PM, CH-4)
• Art from Waste (12:00 PM - 1:30 PM, Vishweshwaraya Hall)
• Sherlock Holmes (1:00 PM - 3:30 PM, CH-3)
• Free Fire (2:00 PM - 4:00 PM, Vivekanandha Hall)
• RJ/VJ Hunt (2:00 PM - 3:30 PM, CH-4)
• Vegetable & Fruit Art (2:00 PM - 3:30 PM, Vishweshwaraya Hall)
• Twin Dance (4:00 PM - 5:30 PM, Ground)\n
Which event would you like to know more about?`,

            'solo': `Solo events:\n
Day 1:
• Tamil Speech     • English Speech
• Singing         • Solo Dance
• Drawing         • Mehandi
• Meme Creation\n
Day 2:
• Photography     • Instrumental Playing
• Short Film      • Mime/Skit
• Best Manager    • RJ/VJ Hunt\n
Which event interests you?`,

            'group': `Group events:\n
Day 1:
• Trailer Time (1-2 members)
• Fireless Cooking (2 members)
• Dump Charades (2-3 members)
• IPL Auction (3 members)
• Lyrical Hunt (2-3 members)
• Divide and Conquer (4-5 members)
• Group Dance (6-15 members)\n
Day 2:
• Rangoli (3-4 members)
• Treasure Hunt (3-4 members)
• Art from Waste (2 members)
• Sherlock Holmes (2-3 members)
• Free Fire (4 members)
• Vegetable & Fruit Art (1-2 members)
• Twin Dance (2 members)\n
Which event would you like to know more about?`,

            'timings': 'Day 1: First event starts at 9:30 AM (Tamil & English Speech)\nLast event ends at 4:00 PM (Group Dance)\n\nDay 2: First event starts at 9:00 AM (Rangoli)\nLast event ends at 5:30 PM (Twin Dance)'
        };

        // Quick navigation shortcuts
        this.quickLinks = [
            'Schedule', 'Register', 'Rules', 'Contact'
        ];
    }

    initializeUI() {
        const assistant = document.createElement('div');
        assistant.className = 'ai-assistant';
        assistant.innerHTML = `
            <button class="ai-toggle">
                <i class="ri-customer-service-2-line"></i>
            </button>
            <div class="ai-chat">
                <div class="ai-header">
                    <div class="ai-header-title">
                        <i class="ri-robot-line"></i>
                        <span>Orlia Assistant</span>
                    </div>
                    <button class="close-chat">
                        <i class="ri-close-line"></i>
                    </button>
                </div>
                <div class="ai-messages"></div>
                <div class="typing-indicator">
                    <div class="typing-dot"></div>
                    <div class="typing-dot"></div>
                    <div class="typing-dot"></div>
                </div>
                <div class="ai-input">
                    <input type="text" placeholder="Ask about events, registration, dates...">
                    <button><i class="ri-send-plane-line"></i></button>
                </div>
            </div>
        `;
        document.body.appendChild(assistant);
    }

    bindEvents() {
        const toggle = document.querySelector('.ai-toggle');
        const chat = document.querySelector('.ai-chat');
        const input = document.querySelector('.ai-input input');
        const sendBtn = document.querySelector('.ai-input button');

        toggle.addEventListener('click', () => {
            chat.classList.toggle('active');
            if (chat.classList.contains('active')) {
                this.addMessage('assistant', 'Hello! How can I help you with Orlia\'25?');
            }
        });

        const sendMessage = () => {
            const message = input.value.trim();
            if (message) {
                this.addMessage('user', message);
                this.processQuery(message);
                input.value = '';
            }
        };

        sendBtn.addEventListener('click', sendMessage);
        input.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') sendMessage();
        });

        const closeBtn = document.querySelector('.close-chat');
        closeBtn.addEventListener('click', () => {
            document.querySelector('.ai-chat').classList.remove('active');
        });
    }

    addMessage(type, text) {
        const messages = document.querySelector('.ai-messages');
        const message = document.createElement('div');
        message.className = `ai-message ${type}`;
        
        const avatar = document.createElement('div');
        avatar.className = 'message-avatar';
        avatar.innerHTML = type === 'assistant' ? 
            '<i class="ri-robot-line"></i>' : 
            '<i class="ri-user-line"></i>';
        
        const content = document.createElement('div');
        content.className = 'message-content';
        
        message.appendChild(avatar);
        message.appendChild(content);
        messages.appendChild(message);
        
        if (type === 'assistant') {
            // Add typing animation for assistant messages
            let index = 0;
            const chars = text.split('');
            const interval = setInterval(() => {
                if (index < chars.length) {
                    const span = document.createElement('span');
                    span.className = 'typing-animation';
                    span.textContent = chars[index];
                    content.appendChild(span);
                    index++;
                    messages.scrollTop = messages.scrollHeight;
                } else {
                    clearInterval(interval);
                }
            }, 30); // Adjust speed here (lower = faster)
        } else {
            // User messages appear instantly
            content.textContent = text;
        }
        
        messages.scrollTop = messages.scrollHeight;
    }

    showTypingIndicator() {
        const messages = document.querySelector('.ai-messages');
        const typing = document.createElement('div');
        typing.className = 'typing-indicator';
        
        const avatar = document.createElement('div');
        avatar.className = 'typing-avatar';
        avatar.innerHTML = '<i class="ri-robot-line"></i>';
        
        const dots = document.createElement('div');
        dots.className = 'typing-dots';
        dots.innerHTML = `
            <div class="typing-dot"></div>
            <div class="typing-dot"></div>
            <div class="typing-dot"></div>
        `;
        
        typing.appendChild(avatar);
        typing.appendChild(dots);
        messages.appendChild(typing);
        
        // Force reflow to trigger animation
        setTimeout(() => typing.classList.add('active'), 0);
    }

    hideTypingIndicator() {
        const typing = document.querySelector('.typing-indicator');
        if (typing) {
            typing.classList.remove('active');
            setTimeout(() => typing.remove(), 300);
        }
    }

    async processQuery(query) {
        this.showTypingIndicator();
        
        // Add delay before processing to show typing indicator
        await new Promise(resolve => setTimeout(resolve, 500));
        
        query = query.toLowerCase();
        let response;

        // Check for specific event queries first
        for (let event in this.eventData) {
            if (query.includes(event)) {
                const info = this.eventData[event];
                response = `${event.toUpperCase()}\n` +
                    `Day: ${info.day}\n` +
                    `Time: ${info.time}\n` +
                    `Venue: ${info.venue}\n` +
                    `Type: ${info.type}\n\n` +
                    `Rules:\n${info.rules.map(rule => `• ${rule}`).join('\n')}\n\n` +
                    `Would you like to know about any other events?`;
                
                this.addMessage('assistant', response);
                this.hideTypingIndicator();
                return;
            }
        }

        // Handle main categories
        if (query.includes('event')) {
            if (query.includes('cultural') || query.includes('dance') || query.includes('sing'))
                response = this.responses.events.cultural;
            else if (query.includes('art') || query.includes('draw'))
                response = this.responses.events.artistic;
            else if (query.includes('technical') || query.includes('film'))
                response = this.responses.events.technical;
            else
                response = this.responses.events.general;
        } 
        else if (query.includes('register')) {
            if (query.includes('deadline'))
                response = this.responses.registration.deadline;
            else if (query.includes('group'))
                response = this.responses.registration.group;
            else
                response = this.responses.registration.solo;
        }
        else if (query.includes('schedule') || query.includes('time')) {
            if (query.includes('morning'))
                response = this.responses.schedule.morning;
            else if (query.includes('afternoon'))
                response = this.responses.schedule.afternoon;
            else
                response = this.responses.schedule.overview;
        }
        // Check for other specific queries
        else if (query.includes('day 1') || query.includes('first day')) {
            response = this.quickResponses.day1;
        } 
        else if (query.includes('day 2') || query.includes('second day')) {
            response = this.quickResponses.day2;
        }
        else if (query.includes('solo')) {
            response = this.quickResponses.solo;
        }
        else if (query.includes('group')) {
            response = this.quickResponses.group;
        }
        else if (query.includes('rule')) {
            if (query.includes('general'))
                response = this.responses.rules.general;
            else
                response = this.responses.rules.participation;
        }
        else if (query.includes('venue') || query.includes('where')) {
            if (query.includes('direction'))
                response = this.responses.venue.directions;
            else
                response = this.responses.venue.facilities;
        }
        else if (query.includes('contact') || query.includes('help')) {
            if (query.includes('support'))
                response = this.responses.contact.support;
            else if (query.includes('emergency'))
                response = this.responses.contact.emergency;
            else
                response = this.responses.contact.general;
        }
        else {
            response = this.responses.default;
            setTimeout(() => this.showQuickLinks(), 1000);
        }

        this.addMessage('assistant', response);
        this.hideTypingIndicator();
    }

    showTimeSlotEvents(day, timeSlot) {
        const events = Object.entries(this.eventData)
            .filter(([_, info]) => info.day === day)
            .filter(([_, info]) => {
                const startTime = parseInt(info.time.split(':')[0]);
                if (timeSlot === 'morning') return startTime < 12;
                return startTime >= 12;
            })
            .map(([name, info]) => `• ${name} (${info.time}, ${info.venue})`)
            .join('\n');

        const response = `${timeSlot.charAt(0).toUpperCase() + timeSlot.slice(1)} events for Day ${day}:\n\n${events}`;
        this.addMessage('assistant', response);
    }

    showQuickLinks() {
        const linksHtml = this.quickLinks.map(link => 
            `<button class="quick-link">${link}</button>`
        ).join('');
        
        const quickLinksContainer = document.createElement('div');
        quickLinksContainer.className = 'quick-links';
        quickLinksContainer.innerHTML = `${linksHtml}`;
        
        const messages = document.querySelector('.ai-messages');
        messages.appendChild(quickLinksContainer);

        // Bind click events
        document.querySelectorAll('.quick-link').forEach(btn => {
            btn.addEventListener('click', () => {
                this.processQuery(btn.textContent);
            });
        });
    }
}

// Initialize assistant when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new OrliaAssistant();
});
