/**
 * Archivo de configuración principal
 * config/config.js
 */

require('dotenv').config();

module.exports = {
  
  // Configuración de la aplicación
  app: {
    name: process.env.APP_NAME || 'MiApp Mobile',
    env: process.env.NODE_ENV || 'development',
    port: process.env.PORT || 3000,
    url: process.env.APP_URL || 'http://localhost:3000',
    version: '1.0.0',
    timezone: 'America/Mexico_City',
    locale: 'es',
  },

  // Base de datos
  database: {
    host: process.env.DB_HOST || 'localhost',
    port: process.env.DB_PORT || 3306,
    name: process.env.DB_NAME || 'miapp_db',
    user: process.env.DB_USER || 'root',
    password: process.env.DB_PASSWORD || '',
    dialect: process.env.DB_DIALECT || 'mysql', // mysql, postgres, sqlite
    charset: 'utf8mb4',
    collation: 'utf8mb4_unicode_ci',
    pool: {
      max: 5,
      min: 0,
      acquire: 30000,
      idle: 10000
    },
    logging: process.env.NODE_ENV === 'development' ? console.log : false,
  },

  // MongoDB (alternativa)
  mongodb: {
    uri: process.env.MONGODB_URI || 'mongodb://localhost:27017/miapp_db',
    options: {
      useNewUrlParser: true,
      useUnifiedTopology: true,
      maxPoolSize: 10,
      serverSelectionTimeoutMS: 5000,
      socketTimeoutMS: 45000,
    }
  },

  // JWT Authentication
  jwt: {
    secret: process.env.JWT_SECRET || 'tu-secreto-super-seguro-cambiar-en-produccion',
    expiresIn: process.env.JWT_EXPIRES_IN || '24h', // 24 horas
    refreshExpiresIn: process.env.JWT_REFRESH_EXPIRES_IN || '7d', // 7 días
    algorithm: 'HS256',
    issuer: 'miapp.com',
    audience: 'miapp-mobile',
  },

  // CORS
  cors: {
    origin: process.env.CORS_ORIGIN || '*',
    methods: ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'],
    allowedHeaders: ['Content-Type', 'Authorization', 'X-Requested-With'],
    exposedHeaders: ['Authorization'],
    credentials: true,
    maxAge: 3600,
  },

  // Email
  email: {
    service: process.env.EMAIL_SERVICE ||