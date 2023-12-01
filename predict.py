# Import required libraries
import mysql.connector
import pandas as pd
from sklearn.preprocessing import MinMaxScaler
from tensorflow.keras.models import Sequential
from tensorflow.keras.layers import LSTM, Dense
import matplotlib.pyplot as plt

# Connect to MySQL database
db_connection = mysql.connector.connect(
  host="localhost",
  user="activrm2_foodwaste",
  password="Active4u.",
  database="activrm2_foodwaste"
)

# Load order data from database into dataframe
order_df = pd.read_sql(
  """
  SELECT order_date, order_total 
  FROM tbl_order
  WHERE order_date < '2022-11-01'
  """, 
  db_connection
)

# Prepare data
X = order_df[['order_date', 'order_total']].values  
y = order_df['order_total'].values

# Scaling 
scaler = MinMaxScaler()
X = scaler.fit_transform(X)

# Reshape 
X = X.reshape((X.shape[0], 1, X.shape[1]))

# Build LSTM 
model = Sequential()
model.add(LSTM(4, input_shape=(1, 2))) 
model.add(Dense(1))
model.compile(optimizer='adam', loss='mae')

# Train model
history = model.fit(X, y, epochs=50, batch_size=16, verbose=1)

# Generate predictions for next 60 days
last_date = pd.to_datetime(order_df['order_date']).max()  
dates = pd.date_range(start=last_date, periods=60, freq='D').tolist()
dates = [[d.strftime("%Y-%m-%d"), 0] for d in dates]
dates_df = pd.DataFrame(dates, columns=['order_date', 'order_total']) 

X_new = scaler.transform(dates_df[['order_date', 'order_total']]) 
X_new = X_new.reshape((X_new.shape[0], 1, X_new.shape[1]))

y_pred = model.predict(X_new)
y_pred = scaler.inverse_transform(y_pred)

# Plot results
plt.figure(figsize=(12, 6))
plt.plot(history.history['loss']) 
plt.xlabel('Epochs')
plt.ylabel('MAE Loss')
plt.title('Model Loss Progress During Training') 

dates_df['order_total'] = y_pred  
plt.figure(figsize=(12, 6))
plt.plot(dates_df['order_date'], dates_df['order_total'])
plt.xlabel('Order Date')
plt.ylabel('Order Total ($)')
plt.title('Future Order Value Predictions')
plt.show()