class VoiceOrder {
    constructor() {
        this.items = [null]; // Of type item
        this.transcription = "";
    }

    // Getters
    getItems() {
        return this.items;
    }

    getTranscription() {
        return this.transcription;
    }

    // Setters
    setItems(items) {
        this.items = items;
    }

    setTranscription(transcription) {
        this.transcription = transcription;
    }
}

module.exports = VoiceOrder;