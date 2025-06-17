const mongoose = require('mongoose');
const paymentSchema = new mongoose.Schema({
    amount: { type: Number, required: true },
    currency: { type: String, required: true },
    status: { type: String, required: true } // example statuses: 'pending', 'completed', 'failed'
});
module.exports = mongoose.model('Payment', paymentSchema);