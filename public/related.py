import numpy as np
from sklearn.metrics.pairwise import cosine_similarity
import pandas as pd

data = pd.read_csv('./public/2.csv', sep=';')
print(data)

Sim = cosine_similarity(data_matrix,data_matrix)
Sim = np.round(Sim, decimals = 2)
Sim