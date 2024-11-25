@extends('adminlte::page')

@section('title', 'PsicoSISTEMA')

@section('content_header')
    <h1>Panel inicial</h1>
@stop

@section('content')
    <p>Bienvenido a PsicoSISTEMA</p>

    <div id="dynamic-content"></div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Imagen de ayuda y WhatsApp --}}
    <div class="help-buttons">
        <img src="{{ asset('images/lamina.png') }}" alt="Ayuda" id="toggle-chatbot" class="help-image">
        <a href="https://wa.me/1234567890" target="_blank" class="whatsapp-help">
            <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" width="50" height="50">
        </a>
    </div>

    {{-- Contenedor del Chatbot --}}
    <div id="chatbot-container" class="chatbot hidden">
        <div class="chatbot-header">
            <span>Chat de Ayuda</span>
            <button id="close-chatbot" class="close-chatbot">✖</button>
        </div>
        <div class="chatbot-messages" id="chatbot-messages">
            <!-- Aquí aparecerán los mensajes del chatbot -->
        </div>
        <div class="chatbot-input">
            <input type="text" id="user-input" placeholder="Escribe un mensaje..." />
            <button id="send-message">Enviar</button>
        </div>
    </div>
@stop

@section('css')
    <style>
        .help-buttons {
            position: fixed;
            bottom: 20px;
            left: 20px;
            z-index: 1050;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .help-image {
            width: 60px;
            height: 60px;
            cursor: pointer;
        }

        .whatsapp-help img {
            border-radius: 50%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .whatsapp-help img:hover {
            transform: scale(1.1);
            transition: transform 0.3s;
        }

        .chatbot {
            position: fixed;
            bottom: 80px;
            left: 20px;
            width: 300px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1050;
            display: flex;
            flex-direction: column;
        }

        .chatbot-header {
            background: #4AC5A6;
            color: #fff;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 10px 10px 0 0;
        }

        .chatbot-messages {
            padding: 10px;
            max-height: 200px;
            overflow-y: auto;
            flex-grow: 1;
            color: #000; /* Color negro para el texto */
        }

        .chatbot-messages .user-message {
            text-align: right;
            color: #000; /* Color negro para mensajes de usuario */
        }

        .chatbot-messages .bot-message {
            text-align: left;
            color: #000; /* Color negro para mensajes del bot */
        }

        .chatbot-input {
            display: flex;
            border-top: 1px solid #ddd;
        }

        .chatbot-input input {
            flex-grow: 1;
            padding: 10px;
            border: none;
            border-radius: 0 0 0 10px;
            outline: none;
        }

        .chatbot-input button {
            background: #4AC5A6;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 0 0 10px 0;
            cursor: pointer;
        }

        .chatbot-input button:hover {
            background: #3a9b84;
        }

        .hidden {
            display: none;
        }
    </style>
@stop

@section('js')
    <script>
$(document).ready(function () {
    const chatbotContainer = $('#chatbot-container');
    const toggleChatbot = $('#toggle-chatbot');
    const closeChatbot = $('#close-chatbot');
    const messagesContainer = $('#chatbot-messages');
    const userInput = $('#user-input');
    const sendMessage = $('#send-message');

    // Abrir/cerrar chatbot
    toggleChatbot.click(() => chatbotContainer.toggleClass('hidden'));
    closeChatbot.click(() => chatbotContainer.addClass('hidden'));

    // Función para mostrar mensajes
    function addMessage(text, isUser = false) {
        const messageClass = isUser ? 'user-message' : 'bot-message';
        messagesContainer.append(`<div class="${messageClass}">${text}</div>`);
        messagesContainer.scrollTop(messagesContainer.prop("scrollHeight"));
    }

    // Función para normalizar texto (elimina tildes y convierte a minúsculas)
    function normalizeText(text) {
        return text
            .toLowerCase()
            .normalize('NFD') // Descompone caracteres con tilde
            .replace(/[\u0300-\u036f]/g, ''); // Elimina los diacríticos
    }

    // Respuestas del chatbot
    const responses = {
        "hola": "¡Hola! ¿En qué puedo ayudarte?",
        "adios": "¡Hasta luego! 😊",
        "gracias": "¡De nada! Estoy aquí para ayudarte.",
        "¿como estas?": "¡Estoy aquí para ayudarte, siempre disponible!",
        "¿cual es tu nombre?": "Soy tu asistenta virutal Lamina, siempre lista para ayudarte.",
        "motivame": "Recuerda: 'El éxito es la suma de pequeños esfuerzos repetidos día tras día'. ¡Tú puedes!",
        "me siento triste": "Lamento escuchar eso. Recuerda que no estás solo y que siempre hay una solución. Respira profundo y da un paso a la vez.",
        "default": "Lo siento, no entiendo eso. ¿Puedes intentarlo de otra manera?"
    };

    // Simular respuestas del chatbot
    function chatbotReply(userMessage) {
        const normalizedMessage = normalizeText(userMessage); // Normaliza el mensaje del usuario
        const reply = responses[normalizedMessage] || responses["default"];
        setTimeout(() => addMessage(reply), 500);
    }

    // Enviar mensaje
    sendMessage.click(() => {
        const message = userInput.val().trim();
        if (message) {
            addMessage(message, true);
            userInput.val('');
            chatbotReply(message);
        }
    });

    // Enviar mensaje con Enter
    userInput.keypress(function (e) {
        if (e.which === 13) sendMessage.click();
    });
});
    </script>
@stop
