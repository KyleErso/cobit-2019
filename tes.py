import heapq
import networkx as nx
import matplotlib.pyplot as plt

# --- Data lokasi dan matriks jarak statis untuk 20 lokasi ---
names = [
    "McDonald’s Pasteur", "Pizza Hut Pasteur", "Bank BCA Dipatiukur", "Indomaret Dipatiukur",
    "Alfamart Dipatiukur", "SPBU Martadinata", "Terminal Ledeng", "Monumen Gasibu",
    "Taman Lansia", "RS Advent Bandung", "RS Hasan Sadikin", "Institut Teknologi Bandung (ITB)",
    "Hotel Savoy Homann", "Kantin Kampus Sekitarnya", "Taman Musik Taman Film", "CGV Blitz Bandung",
    "Trans Studio Mall Bandung", "Jalan Braga", "Alun-alun Bandung", "Gedung Sate"
]

# Contoh matriks jarak 20x20 (0 = tidak terhubung, >0 = jarak dalam satuan km)
adj = [
    [ 0,  3,  5,  2,  0,  8, 10,  6,  7, 12, 15,  4, 11,  9,  7, 13, 14,  5,  2,  9],
    [ 3,  0,  2,  0,  4,  9,  8,  5,  6, 11, 14,  3, 10,  8,  6, 12, 13,  4,  3,  8],
    [ 5,  2,  0,  3,  1,  7,  6,  4,  5, 10, 13,  2,  9,  7,  5, 11, 12,  3,  4,  7],
    [ 2,  0,  3,  0,  5,  8,  9,  6,  7, 12, 15,  4, 11,  9,  7, 13, 14,  5,  2, 10],
    [ 0,  4,  1,  5,  0,  6,  5,  3,  4,  9, 12,  1,  8,  6,  4, 10, 11,  2,  3,  6],
    [ 8,  9,  7,  8,  6,  0,  2,  5,  6,  3,  6,  7,  4,  5,  7,  2,  3,  8,  9,  4],
    [10,  8,  6,  9,  5,  2,  0,  4,  5,  1,  4,  6,  3,  4,  6,  1,  2,  7,  8,  3],
    [ 6,  5,  4,  6,  3,  5,  4,  0,  2,  7, 10,  3,  8,  6,  4,  9, 10,  5,  6,  5],
    [ 7,  6,  5,  7,  4,  6,  5,  2,  0,  8, 11,  4,  9,  7,  5, 10, 11,  6,  7,  6],
    [12, 11, 10, 12,  9,  3,  1,  7,  8,  0,  3, 10,  5,  7,  9,  2,  1, 12, 11,  4],
    [15, 14, 13, 15, 12,  6,  4, 10, 11,  3,  0, 13,  2, 10, 12,  4,  3, 15, 14,  5],
    [ 4,  3,  2,  4,  1,  7,  6,  3,  4, 10, 13,  0,  9,  7,  5, 11, 12,  3,  2,  7],
    [11, 10,  9, 11,  8,  4,  3,  8,  9,  5,  2,  9,  0,  8, 10,  6,  5, 11, 10,  3],
    [ 9,  8,  7,  9,  6,  5,  4,  6,  7,  7, 10,  7,  8,  0,  6,  8,  9,  5,  6,  7],
    [ 7,  6,  5,  7,  4,  7,  6,  4,  5,  9, 12,  5, 10,  6,  0, 12, 13,  4,  5,  8],
    [13, 12, 11, 13, 10,  2,  1,  9, 10,  2,  4, 11,  6,  8, 12,  0,  1, 13, 12,  2],
    [14, 13, 12, 14, 11,  3,  2, 10, 11,  1,  3, 12,  5,  9, 13,  1,  0, 14, 13,  3],
    [ 5,  4,  3,  5,  2,  8,  7,  5,  6, 12, 15,  3, 11,  5,  4, 13, 14,  0,  2,  6],
    [ 2,  3,  4,  2,  3,  9,  8,  6,  7, 11, 14,  2, 10,  6,  5, 12, 13,  2,  0,  9],
    [ 9,  8,  7, 10,  6,  4,  3,  5,  6,  4,  5,  7,  3,  7,  8,  2,  3,  6,  9,  0]
]

def dijkstra(adj_matrix, src):
    n = len(adj_matrix)
    dist = [float('inf')] * n
    prev = [None] * n
    dist[src] = 0
    pq = [(0, src)]
    while pq:
        d, u = heapq.heappop(pq)
        if d > dist[u]: continue
        for v, w in enumerate(adj_matrix[u]):
            if w <= 0: continue
            nd = d + w
            if nd < dist[v]:
                dist[v] = nd
                prev[v] = u
                heapq.heappush(pq, (nd, v))
    return dist, prev


def reconstruct_path(prev, src, dest):
    path = []
    u = dest
    while u is not None:
        path.append(u)
        if u == src: break
        u = prev[u]
    return list(reversed(path))

# --- Visualisasi graf sederhana ---
G = nx.Graph()
for i, name in enumerate(names):
    G.add_node(i, label=name)
for i in range(len(adj)):
    for j in range(i+1, len(adj)):
        if adj[i][j] > 0:
            G.add_edge(i, j, weight=adj[i][j])
# Layout node melingkar
pos = nx.circular_layout(G)
# Gambar graf
plt.figure(figsize=(8,8))
nx.draw(G, pos, with_labels=True, labels={i: i for i in G.nodes()}, node_size=300)
edges = G.edges(data=True)
nx.draw_networkx_edge_labels(G, pos, edge_labels={(u,v): d['weight'] for u,v,d in edges})
plt.title("Peta Sederhana Lokasi (indeks)")
plt.show()

# --- Interaksi pengguna untuk memilih simpul asal & tujuan ---
print("Daftar lokasi (indeks : nama):")
for i, name in enumerate(names):
    print(f"{i:2}: {name}")

src = int(input("Masukkan indeks simpul asal: "))
dest = int(input("Masukkan indeks simpul tujuan: "))

# --- Jalankan Dijkstra dan tampilkan hasil ---
dist, prev = dijkstra(adj, src)
path = reconstruct_path(prev, src, dest)

print()
if dist[dest] == float('inf'):
    print(f"Tidak ada jalur dari {names[src]} ke {names[dest]}.")
else:
    print(f"Lintasan terpendek dari {names[src]} ke {names[dest]}:")
    print(" -> ".join(names[u] for u in path))
    print(f"Jarak total: {dist[dest]} km")

# --- Daftar semua lokasi terurut jarak ---
reachable = [(names[i], dist[i]) for i in range(len(dist)) if dist[i] < float('inf')]
reachable.sort(key=lambda x: x[1])

print()  
print("Daftar lokasi terurut berdasarkan jarak dari sumber:")
for name, d in reachable:
    print(f"- {name}: {d} km")
