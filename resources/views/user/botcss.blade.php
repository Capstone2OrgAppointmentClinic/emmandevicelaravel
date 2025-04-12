<!-- Chatbot Styles -->
<style>
    #chatbot-container {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1000;
    }
    #chatbot-toggle {
        background-color: #f204f2;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 50px;
        cursor: pointer;
        font-size: 16px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    #chatbot-box {
        display: none;
        position: fixed;
        bottom: 80px;
        right: 20px;
        width: 300px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        overflow: hidden;
    }
    #chatbot-header {
        background-color: #f204f2;
        color: white;
        padding: 10px;
        font-weight: bold;
        display: flex;
        justify-content: space-between;
    }
    #close-chatbot {
        cursor: pointer;
    }
    #chatbot-messages {
        height: 300px;
        overflow-y: auto;
        padding: 10px;
        background: #f9f9f9;
    }
    #chatbot-input {
        width: calc(100% - 60px);
        padding: 10px;
        border: none;
        border-top: 1px solid #ddd;
    }
    #chatbot-send {
        width: 50px;
        background: #f204f2;
        color: white;
        border: none;
        cursor: pointer;
    }
</style>
