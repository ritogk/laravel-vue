// ジャイロセンサーに関係するモジュール
// メイン関数のtype
type useGyroSensortType = {
  enableSensor(): void
  addEvent(func: any): void
}

const useGyroSensor = (): useGyroSensortType => {
  // センサーを有効にします。
  const enableSensor = () => {
    // prettier-ignore
    (DeviceOrientationEvent as any)
      .requestPermission()
      .then(function (response: string) {
        alert(response)
        if (response === 'granted') {
          // //. 許可された場合のみイベントハンドラを追加できる
          // window.addEventListener( "deviceorientation", deviceOrientation );
        }
      })
      .catch(function (e: any) {
        console.log(e)
      })
  }

  // イベントハンドラを追加します。
  const addEvent = (func: any) => {
    window.addEventListener('deviceorientation', func, false)
  }

  // // イベントハンドラを削除します。

  return { enableSensor: enableSensor, addEvent: addEvent }
}

export { useGyroSensor }
