document.addEventListener('DOMContentLoaded', function() {
    // Mobile Menu Toggle
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }
    
    // Inscription Modal
    const inscriptionBtn = document.getElementById('inscription-btn');
    const inscriptionModal = document.getElementById('inscription-modal');
    const modalContent = document.getElementById('modal-content');
    const closeModal = document.getElementById('close-modal');
    const inscriptionForm = document.getElementById('inscription-form');
    const formSuccess = document.getElementById('form-success');
    const closeSuccess = document.getElementById('close-success');
    
    if (inscriptionBtn && inscriptionModal && modalContent) {
        inscriptionBtn.addEventListener('click', () => {
            inscriptionModal.classList.remove('hidden');
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        });
        
        function closeModalHandler() {
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                inscriptionModal.classList.add('hidden');
                if (formSuccess) formSuccess.classList.add('hidden');
                if (inscriptionForm) inscriptionForm.classList.remove('hidden');
            }, 300);
        }
        
        if (closeModal) {
            closeModal.addEventListener('click', closeModalHandler);
        }
        
        if (closeSuccess) {
            closeSuccess.addEventListener('click', closeModalHandler);
        }
        
        if (inscriptionForm) {
            inscriptionForm.addEventListener('submit', (e) => {
                e.preventDefault();
                
                // Simulate form submission
                setTimeout(() => {
                    inscriptionForm.classList.add('hidden');
                    if (formSuccess) formSuccess.classList.remove('hidden');
                }, 1000);
            });
        }
    }
    
    // Chat Widget
    const chatBtn = document.getElementById('chat-btn');
    const chatWidget = document.getElementById('chat-widget');
    const closeChat = document.getElementById('close-chat');
    const chatInput = document.getElementById('chat-input');
    const sendMessage = document.getElementById('send-message');
    const chatMessages = document.getElementById('chat-messages');
    
    if (chatBtn && chatWidget) {
        chatBtn.addEventListener('click', () => {
            chatWidget.classList.remove('hidden');
            setTimeout(() => {
                chatWidget.classList.remove('scale-95', 'opacity-0');
                chatWidget.classList.add('scale-100', 'opacity-100');
            }, 10);
        });
        
        if (closeChat) {
            closeChat.addEventListener('click', () => {
                chatWidget.classList.remove('scale-100', 'opacity-100');
                chatWidget.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    chatWidget.classList.add('hidden');
                }, 300);
            });
        }
        
        function sendChatMessage() {
            if (chatInput && chatMessages) {
                const message = chatInput.value.trim();
                if (message) {
                    // Add user message
                    chatMessages.innerHTML += `
                        <div class="flex justify-end mb-4">
                            <div class="py-2 px-3 bg-ge-orange text-white rounded-lg rounded-tr-none max-w-[80%]">
                                <p class="text-sm">${message}</p>
                            </div>
                        </div>
                    `;
                    
                    chatInput.value = '';
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                    
                    // Simulate response after a short delay
                    setTimeout(() => {
                        const responses = [
                            "Merci pour votre message ! Un conseiller vous contactera bientôt.",
                            "Nous avons bien reçu votre demande. Souhaitez-vous plus d'informations sur nos formations ?",
                            "Excellente question ! Nos cours commencent en septembre et janvier.",
                            "Vous pouvez consulter notre catalogue de formations sur notre site web."
                        ];
                        
                        const randomResponse = responses[Math.floor(Math.random() * responses.length)];
                        
                        chatMessages.innerHTML += `
                            <div class="flex mb-4">
                                <div class="w-8 h-8 rounded-full bg-ge-orange flex-shrink-0 flex items-center justify-center text-white font-bold">
                                    G
                                </div>
                                <div class="ml-2 py-2 px-3 bg-gray-100 rounded-lg rounded-tl-none max-w-[80%]">
                                    <p class="text-sm">${randomResponse}</p>
                                </div>
                            </div>
                        `;
                        
                        chatMessages.scrollTop = chatMessages.scrollHeight;
                    }, 1000);
                }
            }
        }
        
        if (sendMessage) {
            sendMessage.addEventListener('click', sendChatMessage);
        }
        
        if (chatInput) {
            chatInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    sendChatMessage();
                }
            });
        }
    }
    
    // Calendar Tabs
    const calendarTabs = document.querySelectorAll('[id^="tab-"]');
    const calendarContents = document.querySelectorAll('[id^="calendar-"]');
    
    if (calendarTabs.length > 0 && calendarContents.length > 0) {
        calendarTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Remove active class from all tabs
                calendarTabs.forEach(t => t.classList.remove('tab-active'));
                
                // Add active class to clicked tab
                tab.classList.add('tab-active');
                
                // Hide all content
                calendarContents.forEach(content => content.classList.add('hidden'));
                
                // Show corresponding content
                const contentId = tab.id.replace('tab-', 'calendar-');
                const contentElement = document.getElementById(contentId);
                if (contentElement) {
                    contentElement.classList.remove('hidden');
                }
            });
        });
    }
    
    // Animation for menu items
    const menuItems = document.querySelectorAll('.menu-item');
    
    menuItems.forEach(item => {
        item.addEventListener('mouseenter', () => {
            if (!item.classList.contains('active')) {
                item.classList.add('hover');
            }
        });
        
        item.addEventListener('mouseleave', () => {
            item.classList.remove('hover');
        });
    });
    
    // Scroll animation
    window.addEventListener('scroll', () => {
        const scrollPosition = window.scrollY;
        const navElement = document.querySelector('nav');
        
        if (navElement) {
            if (scrollPosition > 50) {
                navElement.classList.add('shadow-md');
            } else {
                navElement.classList.remove('shadow-md');
            }
        }
    });
});