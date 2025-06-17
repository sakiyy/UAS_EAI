const express = require('express'); // Pastikan ini ada
const { ApolloServer } = require('apollo-server-express');
const mongoose = require('mongoose');
const dotenv = require('dotenv');
const paymentSchema = require('./schema/paymentSchema');
const paymentResolver = require('./resolvers/paymentResolver');

dotenv.config();

async function startServer() {
  const app = express();
  const server = new ApolloServer({
    typeDefs: paymentSchema,
    resolvers: paymentResolver,
  });

  await server.start();
  server.applyMiddleware({ app });

  mongoose.connect(process.env.MONGODB_URI, {
    useNewUrlParser: true,
    useUnifiedTopology: true,
  })
  .then(() => {
    app.listen({ port: process.env.PORT || 4000 }, () => {
      console.log(`🚀 Server ready at http://localhost:${process.env.PORT || 4000}${server.graphqlPath}`);
    });
  })
  .catch(err => {
    console.error('Database connection error:', err);
  });
}

startServer();
